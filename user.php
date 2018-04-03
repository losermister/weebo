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

  while ($profile_stmt->fetch()) {
    display_userprofile($username, $email, $fav_genre, $profile_img);
  }

  // Release results and close prepared statement to free up memory space
  $profile_stmt->free_result();
  $profile_stmt->close();

  $db->close();

?>