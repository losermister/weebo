<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>

	<div class="container content">
		<h1>All Shows</h1>
		<div class="row">
			<div class="col-3of12">
				<form class="browse-form">
					<?php
						echo "<div class='checkbox-header'>Airing year</div>";
						add_dropdown_filter('All', 'filter-by-year', all_years_list($db), all_years_list($db));
						echo "<div class='checkbox-header'>status</div>";
						add_radiolist('filter-by-status', all_status_list($db), all_status_list($db));
						echo "<div class='checkbox-header'>genre</div>";
						add_checklist('filter-by-multi-genre[]', all_genres_list($db), all_genres_list($db));
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
			</div>
		</div>
	</div>

<script type='text/javascript'>
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
			}
		});
	}

	function getShows() {
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
			}
		});
	}

</script>

<?php
	require('helper/footer.php');
?>
