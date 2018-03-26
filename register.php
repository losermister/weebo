<?php

  require('helper/functions.php');
  require_ssl();
  require('helper/header.php');

  // If form submitted, store entered registration data from POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $fav_genre = trim($_POST['fav_genre']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $profile_img = '';

    // Check that all the entered data are complete and valid, then add to database
    if (registration_data_valid($email, $username, $fav_genre, $password, $password2, $db)) {
      register($email, $username, $password, $fav_genre, $profile_img, $db);
      $_SESSION['valid_user'] = $email;

      // If there's a session variable for a new watchlist item, redirect back to addtowatchlist.php to finish adding the item
      // if (isset($_SESSION['new_watchlist_item'])) {
      //   $new_watchlist_item = $_SESSION['new_watchlist_item'];
      //   $callback_url = "/ngmandyn/A4/addtowatchlist.php";
      //   if (isset($_SESSION['callback_url'])) {
      //     $callback_url = $_SESSION['callback_url'];
      //   }
      //   header("Location: http://" . $_SERVER['HTTP_HOST'] . $callback_url);
      // } else {
      //     header("Location: showmodels.php");
      // }
      header("Location: index.php");

    // If any of the entered data are incomplete or invalid, display the appropriate error
    } else {
        echo "We couldn't process your registration. Please check the following: ";
        echo "<ul>";

        if (!unique_email($email, $db))
          echo "<li>An account already exists with the email <strong>" . $email . "</strong></li>";

        if (!valid_email($email))
          echo "<li>Please enter a valid email</li>";

        if (!unique_username($username, $db))
          echo "<li>An account already exists with the username <strong>" . $username . "</strong></li>";

        if (!valid_username($username))
          echo "<li>Usernames can include only English characters and numbers</li>";

        if ((strlen($username) < 3) || (strlen($username) > 24))
          echo "<li>Your username needs to be between 3 and 24 characters</li>";

        if ($password != $password2)
          echo "<li>Passwords must match</li>";

        if ((strlen($password) < 6) || (strlen($password) > 16))
          echo "<li>Your password needs to be between 6 and 16 characters</li>";

        if (!strong_password($password))
          echo "<li>Your password needs to contain at least 1 number, 1 uppercase character, and 1 lowercase character</li>";

        echo "</ul>";
    }
  }


  /*  1. Create form with legend
   *  2. Add all textfields with labels
   *  3. Close form, and add submit button with text
   */
  form_start('register.php', 'Create a new account');
  add_textfield('email', 'Email: ');
  add_textfield('username', 'Username: ');
  add_textfield('fav_genre', 'Your favourite genre: '); // dropdown
  add_textfield('password', 'Password: ');
  add_textfield('password2', 'Confirm password: ');
  form_end('Sign up');

?>