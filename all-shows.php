<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>

	<div class="container content">

		<div class="row">
			<?php
				$shows_query = "SELECT show_id, name, bg_img "
				             . "FROM shows "
				             . "ORDER BY show_id";
				$shows_stmt = $db->prepare($shows_query);
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