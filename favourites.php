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