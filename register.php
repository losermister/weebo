<?php

  require('helper/functions.php');
  require_ssl();
  require('helper/header.php');

  $avatar_list = array();
  for ($i = 0; $i < $num_of_avatars; $i++) {
    array_push($avatar_list, 'avatar-' . $i);
  }

  // If form submitted, store entered registration data from POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['emailaddress']);
    $username = trim($_POST['username']);
    $fav_genre = $_POST['genre'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $profile_img = $_POST['avatar'];
    $honeypot = $_POST['email']; // hidden field to prevent spam

    echo 'profile img: avatar/' . $profile_img . '.png';

    // Check that all the entered data are complete and valid, then add to database
    if (registration_data_valid($honeypot, $email, $username, $fav_genre, $password, $password2, $db)) {
      register($email, $username, $password, $fav_genre, $profile_img, $db);
      $_SESSION['valid_user'] = $email;
      header("Location: index.php");

    // If any of the entered data are incomplete or invalid, display the appropriate error
    } else {

    		echo "<div id='error' class='small-container'>";
        echo "<h4>We couldn't process your registration. Please check the following:</h4> ";
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

        if (honeypot_caught($honeypot))
          echo "You filled out a field that doesn't exist!";

        echo "</ul>";
        echo "</div>";
    }
  }


  /*  1. Create form with legend
   *  2. Add all textfields with labels
   *  3. Close form, and add submit button with text
   */

  form_start('register.php', 'Create a new weebflix account');
  echo "<p>Get access to 100+ tv shows</p>";
  add_honeypot_textfield('email', 'Email ');
  add_textfield('emailaddress', 'Email ');
  add_textfield('username', 'Username ');
  add_dropdown('your favourite genre', 'genre', all_genres_list($db), all_genres_list($db));
  add_radio_buttons('avatar', $avatar_list);
  add_textfield('password', 'Password ');
  add_textfield('password2', 'Confirm password ');
  form_end('Sign up Now');

?>