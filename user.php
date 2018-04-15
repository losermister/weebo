<?php

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store username from GET method, if valid
  if (isset($_GET['id']) && check_username_list($_GET['id'], $db)) {
    $username = trim($_GET['id']);
  } else {
    echo "Oops! We couldn't find that user.";
    exit;
  }

  // Retrieve user details from products table in database and display
  $profile_query = "SELECT email, fav_genre, profile_img "
                 . "FROM users "
                 . "WHERE user_id = ?";

  $profile_stmt = $db->prepare($profile_query);
  $profile_stmt->bind_param('s', $username);
  $profile_stmt->execute();
  $profile_stmt->bind_result($email, $fav_genre, $profile_img);

  echo "<div class='container'>";

  while ($profile_stmt->fetch()) {
    display_user_profile($username, $email, $fav_genre, $profile_img);
  }

  $profile_stmt->free_result();
  $profile_stmt->close();

  echo "<div class='col-9of12'>";

  $email = email_from_username($username, $db);

  $activity_query = "SELECT video_url, "
                  . "null AS rating, "
                  . "date_added, "
                  . "(SELECT show_id from links WHERE links.video_url = comments.video_url) AS show_id "
                  . "FROM comments where comments.email = ? "
                  . "UNION "
                  . "SELECT null AS video_url, "
                  . "rating, "
                  . "date_added, "
                  . "show_id "
                  . "FROM oso_user_ratings WHERE oso_user_ratings.email = ? "
                  . "ORDER BY date_added DESC "
                  . "LIMIT 10 ";

                  // echo $activity_query;

  $activity_stmt = $db->prepare($activity_query);
  $activity_stmt->bind_param('ss', $email, $email);
  $activity_stmt->execute();
  if ( !$activity_stmt ) {
    printf('errno: %d, error: %s', $db->errno, $db->error);
    die;
  }

  $activity_stmt->bind_result($video_url, $rating, $date_added, $show_id);
  $res = $activity_stmt->get_result();

  $all_activity_results = array();

  while ($row = $res->fetch_row()) {
    $all_activity_results[] = $row;
  }

  $activity_stmt->store_result();
  $activity_stmt->free_result();
  $activity_stmt->close();

  $num_items = sizeof($all_activity_results);

  echo "<h3 class='cat'>Recent Activity</h3>";
  echo "<div class='recent-activity'>";
  for ($i = 0; $i < $num_items; $i++) {
    display_user_activity($username, $all_activity_results[$i][0], $all_activity_results[$i][1], $all_activity_results[$i][2], $all_activity_results[$i][3], $db);
  }
  echo "</div>";

  if ($num_items <= 0) {
    echo "<p>No recent activity to show for $username.</p>";
  }

  echo "</div>";
  echo "</div>";

  $db->close();

  require('helper/footer.php');

?>
