<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
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
<!-- 					<a href="#" class="btn btn-secondary"><span class="fas fa-play"></span><span class='fas fa-bookmark'></span>bookmark</a> -->
					<form action='favourites.php' class='save-btn' method='post'>
            <input type='hidden' name='favourite_show' value='17'>
            <button type='submit' class='btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-bookmark'></span>bookmark</button>
		      </form>
				</div>

			</div>
		</div>


		<div class="banner-overlay">
		</div>

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

							<h3 class="cat">show recommendation</h3>

					</div>

				</div>


				<div class="row">
				<?php
					$shows_query = "SELECT show_id, name, bg_img "
					             . "FROM shows "
					             . "ORDER BY show_id DESC "
					             . "LIMIT 18";
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


<!--
	<footer>

		<div class="container">
			<div class="row">
				Footer text
			</div>

		</div>


	</footer>


</body>
-->

</html>