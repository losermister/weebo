<?php

  //=============================================================================
  // logout.php
  //
  // Log the user out and redirect to the homepage
  //=============================================================================

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store session variable if a user was logged in, and destroy the session
  // Redirect to homepage
  if (isset($_SESSION['valid_user'])) {
    $old_user = $_SESSION['valid_user'];
    unset($_SESSION['valid_user']);
    $_SESSION['logout'] = "You've been logged out!";
    header("Location: index.php");
  }

  require('helper/header.php');

  if (!empty($old_user)) {
    display_notification_success("You've been logged out!");
  } else {
    // Display error message if they weren't logged in but came to this page somehow
    echo "You weren't logged in, so you have not been logged out!";
  }

  require('helper/footer.php');

?>