<?php

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store session variable if a user was logged in, and destroy the session
  if (isset($_SESSION['valid_user'])) {
    $old_user = $_SESSION['valid_user'];
    unset($_SESSION['valid_user']);
    session_destroy();
  }

  require('helper/header.php');

  if (!empty($old_user)) {
    display_notification_success("You've been logged out!");
    echo "You've been logged out!";
  } else {
    // Display error message if they weren't logged in but came to this page somehow
    echo "You weren't logged in, so you have not been logged out!";
  }

?>