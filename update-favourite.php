<?php

	require('helper/functions.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['show_id'])) {
			$show_id = $_POST['show_id'];
	  }
		if (!empty($_POST['action'])) {
			$action = ($_POST['action']);
	  }
		if (!empty($_POST['username'])) {
			$username = $_POST['username'];
      $email = email_from_username($username, $db);
	  }
	}

  if ($action == 'add') {
    if (check_shows_list($show_id, $db) && !in_favourites_list($email, $show_id, $db)) {
      add_to_favourites($email, $show_id, $db);
    }
  } else if ($action == 'remove') {
    if (check_shows_list($show_id, $db) && in_favourites_list($email, $show_id, $db)) {
      remove_from_favourites($email, $show_id, $db);
    }
  }

  echo get_num_favourites($db);

	$db->close();

?>