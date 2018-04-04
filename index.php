<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');

  if (isset($_SESSION['valid_user'])) {
    $email = $_SESSION['valid_user'];
  } else {
  	$email = "";
  }
?>

	<div class="banner-container">
		<div class="container">
			<div class="banner-text">
				<div class="col-12of12">
					<span>staff pick</span>
				</div>
			</div>
			<div class="banner-details">
				<div class="col-6of12">
					<h2>kill la kill</h2>
					<p>During her family's move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches, and spirits, and where humans are changed into beasts.</p>
					<a href="http://localhost/weebo/show.php?id=17" class="btn btn-primary"><!-- <span class="fas fa-play"></span> -->watch series</a>
					<form action='favourites.php' class='save-btn' method='post'>
						<?php
							$featured_show = 17;
	            if (in_favourites_list($email, $featured_show, $db)) {
	              echo "<input type='hidden' name='unfavourite_show' value='17'>
	              <button type='submit' class='bkmrk-state btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-check'></span>saved</button>";
	            } else {
	                echo "<input type='hidden' name='favourite_show' value='17'>
	                <button type='submit' class='btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-bookmark'></span>favourite</button>";
	              }
						?>
					</form>
				</div>
			</div>
		</div>
		<div class="banner-overlay"></div>
		<div class="banner-img-container">
			<div class="show-img" style="background-image:url('http://i0.kym-cdn.com/photos/images/original/000/686/177/af4.jpg')"></div>
		</div>
	</div>

	<div class="container content">
		<div class="row content" >
			<div class="col-3of12">
				<div class="row">
					<div class="col-12of12">
						<h3 class="cat">recent uploads</h3>
					</div>
				</div>
				<div class="row" id="">
					<?php
						$recents_query = "SELECT shows.show_id, name, episode_num, bg_img "
						               . "FROM links "
						               . "LEFT JOIN shows "
						               . "ON links.show_id = shows.show_id "
						               . "ORDER BY date_added "
						               . "DESC LIMIT 10";
						$recents_stmt = $db->prepare($recents_query);
						$recents_stmt->execute();
						$recents_stmt->bind_result($show_id, $show_name, $episode_num, $show_img);
						while ($recents_stmt->fetch()) {
							display_show_list($show_id, $show_name, $episode_num, $show_img);
						}
					  $recents_stmt->free_result();
					  $recents_stmt->close();
					 ?>
				</div>
			</div>
			<div class="col-9of12">
				<div class="row">
					<div class="col-12of12">
							<?php
								if (isset($_SESSION['valid_user'])) {
									$email = $_SESSION['valid_user'];
								}

								if (isset($_SESSION['valid_user']) && sizeof(rated_shows_list($email, $db)) > 1) {
									echo "<h3 class=\"cat\">Recommended for you</h3>";
								} else {
									echo "<h3 class=\"cat\">Top rated</h3>";
								}
							?>
					</div>
				</div>
				<div class="row">
					<?php
						if (isset($_SESSION['valid_user']) && sizeof(rated_shows_list($email, $db)) > 1) {
							require './OpenSlopeOne.php';
							$openslopeone = new OpenSlopeOne();
							$openslopeone->initSlopeOneTable('MySQL');
							$recs = $openslopeone->getRecommendedItemsByUser($email, 18);
              $recs = remove_already_rated($recs, $email, $db);
							foreach ($recs as $rec) {
								$shows_query = "SELECT avg(rating) as avg_rating, shows.show_id, shows.name, shows.bg_img "
								             . "FROM oso_user_ratings "
								             . "INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
								             . "GROUP BY oso_user_ratings.show_id "
								             . "HAVING show_id = $rec ";

								$shows_stmt = $db->prepare($shows_query);
								$shows_stmt->execute();
								$shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);
								$shows_stmt->store_result();

								while ($shows_stmt->fetch()) {
									display_show_card($avg_rating, $show_id, $show_name, $show_img, $db);
								}
								$shows_stmt->free_result();
							  $shows_stmt->close();
							}
						} else {
								$shows_query = "SELECT avg(rating) as avg_rating, shows.show_id, shows.name, shows.bg_img "
								             . "FROM oso_user_ratings "
								             . "INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
								             . "GROUP BY oso_user_ratings.show_id "
								             . "ORDER BY avg(rating) DESC "
								             . "LIMIT 18";

								$shows_stmt = $db->prepare($shows_query);
								$shows_stmt->execute();
								$shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);
								$shows_stmt->store_result();

								while ($shows_stmt->fetch()) {
									display_show_card($avg_rating, $show_id, $show_name, $show_img, $db);
								}
								$shows_stmt->free_result();
							  $shows_stmt->close();
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