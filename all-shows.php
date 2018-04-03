<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>

	<div class="container content">
		<h1>All Shows</h1>
		<div class="row">
			<?php
				$shows_query = "SELECT show_id, name, bg_img "
				             . "FROM shows "
				             . "ORDER BY show_id";
				$shows_stmt = $db->prepare($shows_query);
				$shows_stmt->execute();

				$shows_stmt->bind_result($show_id, $show_name, $show_img);
				$shows_stmt->store_result();

				while ($shows_stmt->fetch()) {
					display_show_card($show_id, $show_name, $show_img, $db);
				}

				$shows_stmt->free_result();
			 	$shows_stmt->close();
			?>
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