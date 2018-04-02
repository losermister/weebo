<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>
		<div class='notify-msg-container'>
		<span class='notify-text'>Some Message</span>
	</div>
	<div class="container content">

		<h1>My Favourite Shows</h1>

		<div class="row">
			<?php
        if (isset($_SESSION['valid_user'])) {
        	$email = $_SESSION['valid_user'];
        }

			  if (isset($_POST['favourite_show'])) {
			    $new_favourite_id = $_POST['favourite_show'];

			    if (check_shows_list($new_favourite_id, $db) && !in_favourites_list($email, $new_favourite_id, $db)) {
			    	add_to_favourites($email, $new_favourite_id, $db);
			    	echo "Successfully added " . showname_from_id($new_favourite_id, $db) . " to your favourites!";
			    } else if (!check_shows_list($new_favourite_id, $db)) {
			    	echo "Not added: Invalid product code " . $new_favourite_id . " was submitted.";
			    } else if (in_favourites_list($email, $new_favourite_id, $db)) {
			    	remove_from_favourites($email, $new_favourite_id, $db);
			    	echo "Removed " . showname_from_id($new_favourite_id, $db) . " from your favourites.";
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

				while ($shows_stmt->fetch()) {
					display_show_card($show_id, $show_name, $show_img);
				}

				$shows_stmt->free_result();
			  $shows_stmt->close();
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