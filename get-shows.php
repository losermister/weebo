<?php

	$filtered_year = '';
	$filtered_genres = '';
	$num_filtered_genres = 0;
	$filtered_status = '';
	$current_page = 1;

	require('helper/functions.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['filter-by-year'])) {
			$filtered_year = $_POST['filter-by-year'];
	  }
		if (!empty($_POST['filter-by-status'])) {
			$filtered_status = $_POST['filter-by-status'];
	  }
	  if (!empty($_POST['filter-by-multi-genre'])) {
			$num_filtered_genres = count($_POST['filter-by-multi-genre']);
			// $filtered_genres = "'" . implode ("', '", $_POST['filter-by-multi-genre']) . "'";
			$filtered_genres = $_POST['filter-by-multi-genre'];
	  }
		if (!empty($_POST['page'])) {
			$current_page = $_POST['page'];
	  }
		if (!empty($_POST['curpage'])) {
			$current_page = $_POST['curpage'];
	  }
	}
	// echo count(all_genres_list($db));

	// echo $filtered_year . "<br>";
	// print_r($filtered_genres) . "<br>";
	// echo $num_filtered_genres . "<br>";
	// $flags = str_repeat('s', count(all_genres_list($db))) . 'ii';
  //  echo $flags;


	$shows_query = "SELECT avg_show_rating AS 'avg_rating', shows.show_id, shows.name, shows.bg_img "
	             . "FROM shows "
	             . "JOIN ( SELECT shows.show_id AS show_id, AVG(rating) AS avg_show_rating "
	             . "       FROM oso_user_ratings "
	             . "       INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
	             . "       GROUP BY shows.show_id "
	             . "      ) AS avg_finder ON shows.show_id = avg_finder.show_id "
	             . "INNER JOIN genres on shows.show_id = genres.show_id ";

	if (!empty($_POST['filter-by-year']) && $filtered_year != 'All') {
	 	$shows_query .= "WHERE YEAR (airing_date) = $filtered_year ";
	}

	if (!empty($_POST['filter-by-multi-genre'])) {
		for($i = 0; $i < $num_filtered_genres; $i++) {
			if ($i == 0) {
				$shows_query .= "AND (genres.genre = '$filtered_genres[$i]' ";
				if ($num_filtered_genres <= 1) {
					$shows_query .= ") ";
				}
			} else {
				$shows_query .= "OR genres.genre = '$filtered_genres[$i]' ";
				if ($i == $num_filtered_genres-1) {
					$shows_query .= ") ";
				}
			}
	 	// $shows_query .= "WHERE genres.genre IN ($filtered_genres) ";
		}
	}

	if (!empty($_POST['filter-by-status']) && $filtered_status != 'All') {
	 	$shows_query .= "AND shows.status = '$filtered_status' ";
	}
	$shows_query .= "GROUP BY shows.show_id ";
	// if (!empty($_POST['filter-by-multi-genre'])) {
	//  	$shows_query .= "HAVING COUNT(genre) >= $num_filtered_genres ";
	// }
	$shows_query .= "ORDER BY shows.show_id";

	$res = $db->query($shows_query);

	while ($row = $res->fetch_row()) {
		 $all_show_results[] = $row;
	}

	if ($res->num_rows <= 0) {
		echo "<h2>No shows found</h1>";
		echo "<p>Oops, nothing matched your filter criteria.</p>";
	}

	$num_items = $res->num_rows;
	$pages = ceil($num_items / $items_per_page);
	$offset = ($current_page - 1) * $items_per_page;

	// echo "num_items: " . $num_items . "<br>";
	// echo "items per page: " . $items_per_page . "<br>";
	// echo "pages: " . $pages . "<br>";
	// echo "current page: " . $current_page . "<br>";
	// echo "offset: " . $offset . "<br>";

	$res->free_result();

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

	$db->close();

 	exit;

?>

<script type='text/javascript'>

	function updateFavs() {
		event.preventDefault();
		var show_id = $(this).closest('.show-info').attr('data-show-id')
		var username = $('#user-click').text()

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
