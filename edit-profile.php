<?php

  require('helper/functions.php');
  require_ssl();
  require('helper/header.php');

  $avatar_list = array();
  for ($i = 0; $i < $num_of_avatars; $i++) {
    array_push($avatar_list, 'avatar-' . $i);
  }

  if (!isset($_SESSION['valid_user'])) {
    echo "Oops! You need to be logged in to edit your profile. ";
    echo "<a href=\"login.php\">Log in</a>";
    exit;
  } else {
      $email = $_SESSION['valid_user'];
  }

  if (isset($_SESSION['update_profile'])) {
    display_notification_success("Successfully updated your profile!");
    unset($_SESSION['update_profile']);
  }

  // If form submitted, store entered registration data from POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $fav_genre = $_POST['genre'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $profile_img = $_POST['avatar'];

    // Check that all the entered data are complete and valid, then add to database
    if (updated_user_data_valid($username, $fav_genre, $password, $password2, $db)) {
      update_profile($email, $username, $password, $fav_genre, $profile_img, $db);
      $_SESSION['update_profile'] = 'Success!';
      header("Location: edit-profile.php");

    // If any of the entered data are incomplete or invalid, display the appropriate error
    } else {
        echo "We couldn't update your profile. Please check the following: ";
        echo "<ul>";

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

  form_start('edit-profile.php', 'Edit public profile');
  add_radio_buttons('avatar', $avatar_list);
  add_textfield('username', 'Username ');
  add_dropdown('your favourite genre', 'genre', all_genres_list($db), all_genres_list($db));

  add_textfield('password', 'Password ');
  add_textfield('password2', 'Confirm password ');
  form_end('Update');

?>
