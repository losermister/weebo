<?php

  require('helper/functions.php');
  require_ssl();
  require('helper/header.php');

  if (isset($_SESSION['require_login'])) {
    display_notification_error($_SESSION['require_login']);
    unset($_SESSION['require_login']);
  }

  // If login credentials submitted, check to see if there's a record in the database
  if (isset($_POST['email']) && (isset($_POST['password']))) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT users.hashed_password "
                 . "FROM users "
                 . "WHERE email = ? ";
    $login_stmt = $db->prepare($login_query);
    $login_stmt->bind_param('s', $email);
    $login_stmt->execute();
    $login_stmt->bind_result($pass_hash);

    // If there's a record, verify the password before logging in
    if ($login_stmt->fetch() && password_verify($password, $pass_hash)) {
      $_SESSION['valid_user'] = $email;
      header("Location: index.php");
    } else {
    	echo "<div id='error' class='small-container'>";
    	echo "<ul>";
    	echo "<h4>Something went wrong</h4>";
      echo "<li>Incorrect email or password</li>";
      echo "</ul>";
      echo "</div>";
    }

    // Release results and close prepared statement to free up memory space
    $login_stmt->free_result();
    $login_stmt->close();

    $db->close();
  }

  /*  1. Create form with legend
   *  2. Add all textfields with labels
   *  3. Add link to registration page
   *  4. Close form, and add submit button with text
   */
  form_start('login.php', 'Sign In');
  echo "<p>Don't have an account?<a href=\"register.php\"> Create your account.</a></p>";
  add_textfield('email', 'Email ');
  add_textfield('password', 'Password ');
  form_end('Log in');

?>