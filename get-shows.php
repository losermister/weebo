<?php

	$filtered_year = '';
	$filtered_genres = '';
	$num_filtered_genres = 0;

	require('helper/functions.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['filter-by-year'])) {
			$filtered_year = $_POST['filter-by-year'];
	  }
	  if (!empty($_POST['filter-by-multi-genre'])) {
			$num_filtered_genres = count($_POST['filter-by-multi-genre']);
			$filtered_genres = "'" . implode ("', '", $_POST['filter-by-multi-genre']) . "'";
	  }
	}

	// echo count(all_genres_list($db));

	// echo $filtered_year . "<br>";
	// echo $filtered_genres . "<br>";
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
	if (!empty($_POST['filter-by-multi-genre'])) {
	 	$shows_query .= "WHERE genres.genre IN ($filtered_genres) ";
	}
	if (!empty($_POST['filter-by-year']) && $filtered_year != 'All') {
	 	$shows_query .= "AND YEAR (airing_date) = $filtered_year ";
	}
	$shows_query .= "GROUP BY shows.show_id ";
	if (!empty($_POST['filter-by-multi-genre'])) {
	 	$shows_query .= "HAVING COUNT(genre) >= $num_filtered_genres ";
	}
	$shows_query   .= "ORDER BY shows.show_id";

	// echo $shows_query;

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
 // 	$shows_stmt->close();

	$res = $db->query($shows_query);

	while ($row = $res->fetch_row()) {
		display_show_card($row[0], $row[1], $row[2], $row[3], $db);
	}

	$res->free_result();
	$db->close();

 	exit;

?>