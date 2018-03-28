<?php

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store show ID from GET method, if valid
  if (isset($_GET['id']) && check_shows_list($_GET['id'], $db)) {
    $show_id = trim($_GET['id']);
  } else {
    echo "Oops! We couldn't find that show.";
    exit;
  }

  $show_query = "SELECT name, description, banner_img, anime_trailer, name_jp, status, airing_date, avg_rating "
               . "FROM shows "
               . "WHERE show_id = ?";
  $show_stmt = $db->prepare($show_query);
  $show_stmt->bind_param('i', $show_id);
  $show_stmt->execute();
  $show_stmt->bind_result($show_name, $description, $banner_img, $anime_trailer, $name_jp, $status, $airing_date, $avg_rating);

  while ($show_stmt->fetch()) {
    echo "<img src=\"" . $banner_img . "\">";
    echo "<h1>$show_name</h1>";
    echo "<p>$name_jp</p>";
    echo "<p>Airing date: $airing_date</p>";
    echo "<p>Status: $status</p>";
    echo "<p>Average rating: $avg_rating</p>";
    echo "<p>$description</p>";
    echo "​<iframe width=\"560\" height=\"315\" src=\"" . $anime_trailer . "\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>";
  }

  $show_stmt->free_result();
  $show_stmt->close();

  $db->close();

?>