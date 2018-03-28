<?php

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store show ID and episode number from GET method, if valid
  if (isset($_GET['show']) && check_shows_list($_GET['show'], $db)) {
    $show_id = $_GET['show'];
    $show_name = showname_from_id($show_id, $db);

    if (isset($_GET['ep']) && check_episodes_list($_GET['ep'], $_GET['show'], $db)) {
      $ep_num = $_GET['ep'];
    } else {
      echo "Sorry! We couldn't find that video. ";
      echo "<a href=\"show.php?id=$show_id\">Back to $show_name</a>";
      exit;
    }

  } else {
    echo "Oops! We couldn't find that video. ";
    echo "<a href=\"index.php\">Back to homepage</a>";
    exit;
  }

  $episode_query = "SELECT video_url "
               . "FROM links "
               . "WHERE show_id = ? AND episode_num = ? "
               . "ORDER BY episode_num";
  $episode_stmt = $db->prepare($episode_query);
  $episode_stmt->bind_param('ii', $show_id, $ep_num);
  $episode_stmt->execute();
  $episode_stmt->bind_result($video_url);

  echo "<h1>$show_name: Episode $ep_num</h1>";

  // TODO: embed video on page
  while ($episode_stmt->fetch()) {
    echo "$video_url";
  }

  $episode_stmt->free_result();
  $episode_stmt->close();

  $db->close();

?>