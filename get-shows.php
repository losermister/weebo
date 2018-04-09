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

	// echo $shows_query . "<br>";

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