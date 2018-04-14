<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');

	$genre = '';

	if (isset($_GET['genre'])) {
	  $genre = mysqli_real_escape_string($db, $_GET['genre']);
	}

?>

	<div class="container content">
		<h1>All <?php echo $genre; ?> Shows</h1>
		<div class="row">
			<div class="col-3of12">
				<form class="browse-form">
					<?php

						echo "<div class='checkbox-header'>Airing year</div>";
						add_dropdown_filter('All', 'filter-by-year', all_years_list($db), all_years_list($db));
						echo "<div class='checkbox-header'>status</div>";
						add_radiolist('filter-by-status', all_status_list($db), all_status_list($db));
						echo "<div class='checkbox-header'>genre</div>";

						if (isset($_GET['genre'])) {
							echo $genre;
							add_checklist('filter-by-multi-genre[]', all_genres_list($db), all_genres_list($db), $genre);
						} else {
							add_checklist('filter-by-multi-genre[]', all_genres_list($db), all_genres_list($db));
						}
					?>
				</form>
			</div>
			<div class="col-9of12">

				<?php
					$shows_query = "SELECT avg(rating) as avg_rating, shows.show_id, shows.name, shows.bg_img "
					             . "FROM oso_user_ratings "
					             . "INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
					             . "GROUP BY oso_user_ratings.show_id "
					             . "ORDER BY shows.show_id";

					$shows_stmt = $db->prepare($shows_query);
					$shows_stmt->execute();

					$shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);

					$res = $shows_stmt->get_result();

					while ($row = $res->fetch_row()) {
						$all_show_results[] = $row;
					}

					$num_items = sizeof($all_show_results);
					$pages = ceil($num_items / $items_per_page);
					$current_page = 1;
					$offset = ($current_page - 1) * $items_per_page;

					$shows_stmt->store_result();
					$shows_stmt->free_result();
				 	$shows_stmt->close();

				?>

				<?php
				 	echo "<section id='show-page-nav'>";
					add_page_nav($current_page, $pages, 'page-nav');
					echo "</section>";
				?>

				<section id="show-data" class="fade-in">

				<div class="loading-overlay" style="display: none; color: white;">
					<span class="overlay-content">Loading...</span>
				</div>
				<?php

					// echo "num_items: " . $num_items . "<br>";
					// echo "items per page: " . $items_per_page . "<br>";
					// echo "pages: " . $pages . "<br>";
					// echo "current page: " . $current_page . "<br>";
					// echo "offset: " . $offset . "<br>";

					// print_r($all_show_results);

					if ($current_page < $pages) {
						for ($i = $offset; $i < $offset+$items_per_page; $i++) {
							display_show_card($all_show_results[$i][0], $all_show_results[$i][1], $all_show_results[$i][2], $all_show_results[$i][3], $db);
						}
					} else {
						for ($i = $offset; $i < $num_items; $i++) {
				      display_show_card($all_show_results[$i][0], $all_show_results[$i][1], $all_show_results[$i][2], $all_show_results[$i][3], $db);
						}
					}

				?>
				</section>
				<?php
					echo "<section id='show-page-nav'>";
					add_page_nav($current_page, $pages, 'page-nav');
					echo "</section>";
				?>
			</div>
		</div>
	</div>

<script type='text/javascript'>

	function updateFavs() {
		var show_id = $(this).closest('.show-info').attr('data-show-id')
		var username = $('#user-click').text()

		if (username !== '') {
			event.preventDefault();

			if (!$(this).hasClass('saved-state')) {
				$(this).addClass('saved-state animated bounceIn')
				$(this).children().removeClass('fa-heart animated bounceIn')
				$(this).children().addClass('fa-check')
				var action = 'add'
			} else {
				$(this).removeClass('saved-state animated bounceIn')
				$(this).children().removeClass('fa-check')
				$(this).children().addClass('fa-heart animated bounceIn')
				var action = 'remove'
			}
			console.log($(this).closest('.show-info').attr('data-show-id'))
			console.log(username)
			console.log(action)

	    $.ajax({
	      type: 'POST',
	      url:  'update-favourite.php',
	      data: { show_id : show_id, action : action, username : username },
	      success:function(html) {
			     $('.display-favs').load(
			     	document.URL +  ' .display-favs',
			     	function() {
			     		$('.save').off();
			     		addClickHandler();
			     	})
	        $('.fvr-lnk a span').html(html)
	        $('.fvr-lnk a span').animate({
			      top: "-5"
			    }, {
			      queue: false,
			      duration: 200
			    })
			    .animate({ top: "0" }, 100 );
	      }
	    });
	  }
	}

	function addClickHandler() {
		$('.save').click(updateFavs);
	}

	addClickHandler();

	$('[id=filter-page]').change(function() {
		// updatePages()
		getShows()
		console.log($('.browse-form').serialize())
	});

	$('[id=filter-by-status], [id=filter-by-year], [id=filter-by-multi-genre]').change(function() {
		resetPage()
		updatePages()
		console.log($('.browse-form').serialize() + "&curpage=" + 1)
	});

	function resetPage() {
		$.ajax({
			type: 'POST',
			url:  'update-pages.php',
			data: $('.browse-form').serialize() + "&curpage=" + 1,
			success:function(html) {
				$('#show-page-nav').html(html);
				$('.save').off();
     		addClickHandler();
			}
		});
	}

	function getShows() {
		console.log('resetPage')
		$.ajax({
			type: 'POST',
			url:  'get-shows.php',
			data: $('.browse-form').serialize(),
			beforeSend:function(html) {
				$('.loading-overlay').show();
			},
			success:function(html) {
				$('.loading-overlay').hide();
				$('#show-data').html(html).hide().fadeIn('fast');
				$('.save').off();
     		addClickHandler();
			}
		});
	}

	function updatePages() {
		console.log('updatepages')
		$.ajax({
			type: 'POST',
			url:  'get-shows.php',
			data: $('.browse-form').serialize() + "&curpage=" + 1,
			beforeSend:function(html) {
				$('.loading-overlay').show();
			},
			success:function(html) {
				$('.loading-overlay').hide();
				$('#show-data').html(html).hide().fadeIn('fast');
				$('.save').off();
     		addClickHandler();
			}
		});
	}

</script>

<?php
	require('helper/footer.php');
?>
