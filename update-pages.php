<?php

	$filtered_year = '';
	$filtered_genres = '';
	$num_filtered_genres = 0;
	$filtered_status = '';

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

	// $shows_stmt = $db->prepare($shows_query);
 //  if (!$shows_stmt) {
 //    printf('errno: %d, error: %s', $shows_stmt->errno, $shows_stmt->error);
 //    die;
 //  }

	// $shows_stmt->bind_param($flags, $filtered_genre_str, $filtered_year, $num_filtered_genres);
	// $shows_stmt->execute();

	// $shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);
	// $shows_stmt->store_result();

	// while ($shows_stmt->fetch()) {
	// 	display_show_card($avg_rating, $show_id, $show_name, $show_img, $db);
	// }

	// $shows_stmt->free_result();
 // $shows_stmt->close();

	$res = $db->query($shows_query);

	while ($row = $res->fetch_row()) {
		 $all_show_results[] = $row;
	}

	$num_items = $res->num_rows;
	$pages = ceil($num_items / $items_per_page);

	add_page_nav(1, $pages, 'page-nav');

?>

<script type='text/javascript'>
	$('[id=filter-page]').change(function() {
		getShows()
		console.log($('.browse-form').serialize())
	});

	function resetPage() {
		$.ajax({
			type: 'POST',
			url:  'update-pages.php',
			data: $('.browse-form').serialize() + "&curpage=" + 1,
			success:function(html) {
				$('#show-page-nav').html(html);
				// $('#show-page-nav').html(html);
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
				// $('#show-page-nav').html(html);
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
				// $('#show-page-nav').html(html);
			}
		});
	}

</script>

<?php
	require('helper/footer.php');
?>