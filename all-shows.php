<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>

	<div class="container content">
		<h1>All Shows</h1>
		<div class="row">
			<?php
				$shows_query = "SELECT avg(rating) as avg_rating, shows.show_id, shows.name, shows.bg_img "
				             . "FROM oso_user_ratings "
				             . "INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
				             . "GROUP BY oso_user_ratings.show_id "
				             . "ORDER BY shows.show_id";

				$shows_stmt = $db->prepare($shows_query);
				$shows_stmt->execute();

				$shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);
				$shows_stmt->store_result();

				$shows_count = '';

				while ($shows_stmt->fetch()) {
					display_show_card($avg_rating, $show_id, $show_name, $show_img, $db);
					$shows_count++;
				}

				$pages = '';
				echo "count: ". $shows_count . "<br>";
				$pages = ceil($shows_count / $shows_per_page);
				echo "pages: " . $pages;

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
