<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>

	<div class="container content">

		<h1>My Favourite Shows</h1>

		<div class="row">
			<?php
	      if (isset($_SESSION['valid_user'])) {
	      	$email = $_SESSION['valid_user'];
	      } else {
	      	$_SESSION['require_login'] = 'You need to be logged in to do that!';
	      	header('Location: login.php');
	      }

			  if (isset($_POST['favourite_show'])) {
			    $new_favourite_id = $_POST['favourite_show'];

			    if (check_shows_list($new_favourite_id, $db) && !in_favourites_list($email, $new_favourite_id, $db)) {
			    	add_to_favourites($email, $new_favourite_id, $db);
			    	display_notification_success("Successfully added " . showname_from_id($new_favourite_id, $db) . " to your favourites!");
			    } else if (!check_shows_list($new_favourite_id, $db)) {
			    	display_notification_error("Not added: Invalid show ID " . $new_favourite_id . " was submitted.");
			    }

			  } else if (isset($_POST['unfavourite_show'])) {
			  	$unfavourite_id = $_POST['unfavourite_show'];
			  	if (check_shows_list($unfavourite_id, $db) && in_favourites_list($email, $unfavourite_id, $db)) {
			    	remove_from_favourites($email, $unfavourite_id, $db);
			    	display_notification_success("Removed " . showname_from_id($unfavourite_id, $db) . " from your favourites.");
			  	}
			  }

				$shows_query = "SELECT favourite_shows.show_id, shows.name, shows.bg_img "
				             . "FROM favourite_shows "
				             . "INNER JOIN shows ON favourite_shows.show_id = shows.show_id "
				             . "WHERE email = ?";
				$shows_stmt = $db->prepare($shows_query);
				$shows_stmt->bind_param('s', $email);
				$shows_stmt->execute();
				$shows_stmt->bind_result($show_id, $show_name, $show_img);
				$result = $shows_stmt->get_result();
				$shows_stmt->free_result();
			  $shows_stmt->close();

				while ($row = $result->fetch_array(MYSQLI_NUM)) {
				   display_show_card($row[0], $row[1], $row[2], $db);
				}

			?>
		</div>
	</div>
</div>

<footer>
	<div class="container">
		<div class="row">
			Footer text
		</div>
	</div>
</footer>

</body>

</html>