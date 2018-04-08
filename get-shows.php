<?php
	require('helper/functions.php');

	if (!empty($_POST['type']) && !empty($_POST['val'])) {
		$filteredGenre = $_POST['val'];
	}

	$shows_query = "SELECT avg_show_rating AS 'avg_rating', shows.show_id, shows.name, shows.bg_img "
	             . "FROM shows "
	             . "JOIN ( SELECT shows.show_id AS show_id, AVG(rating) AS avg_show_rating "
	             . "       FROM oso_user_ratings "
	             . "       INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
	             . "       GROUP BY shows.show_id "
	             . "      ) AS avg_finder ON shows.show_id = avg_finder.show_id "
	             . "INNER JOIN genres on shows.show_id = genres.show_id "
	             . "WHERE genres.genre = ?";

	$shows_stmt = $db->prepare($shows_query);
	$shows_stmt->bind_param('s', $filteredGenre);
	$shows_stmt->execute();

	$shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);
	$shows_stmt->store_result();

	while ($shows_stmt->fetch()) {
		display_show_card($avg_rating, $show_id, $show_name, $show_img, $db);
	}

	$shows_stmt->free_result();
 	$shows_stmt->close();

 	exit;

?>