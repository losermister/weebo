<?php

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store show ID from GET method, if valid
  if (isset($_GET['id']) && check_shows_list($_GET['id'], $db)) {
    $show_id = trim($_GET['id']);
  } else {
    echo "Oops! We couldn't find that show.";
    exit;
  }

  $genres = implode(', ', genres_list_from_id($show_id, $db));

  $show_query = "SELECT name, bg_img, description, banner_img, anime_trailer, name_jp, status, airing_date, avg_rating "
              . "FROM shows "
              . "WHERE show_id = ?";
  $show_stmt = $db->prepare($show_query);
  $show_stmt->bind_param('i', $show_id);
  $show_stmt->execute();
  $show_stmt->bind_result($show_name, $show_img, $description, $banner_img, $anime_trailer, $name_jp, $status, $airing_date, $avg_rating);

  while ($show_stmt->fetch()) {
    echo "
   	<div class='banner-container'>
	 	<div class='container'>
	 		<div class='banner-details'>

				<div class='col-6of12'>
					<h2>$show_name</h2>
					<p>$name_jp</p>
					<a href='http://localhost/weebo/show.php?id=17' class='btn btn-primary'>play trailer</a>
					<a href='#' class='btn btn-secondary'><span class='fas fa-bookmark'></span>bookmark</a>
				</div>


			</div>
	 	</div>

    <div class='banner-overlay'></div>

		<div class='banner-img-container'>
			<div class='show-img' style='background-image:url(\"" . $banner_img . "\")'></div>
		</div>


    </div>
    ";


    echo "
    <div class='container'>
	    <div class='col-3of12'>
				<div class='row'>
					<div class='col-12of12'>
							<h3 class='cat'>sypnosis</h3>
					</div>
				</div>


				<div class='row'>
					<div class='col-12of12'>
					  <div class='info'>
					   <p>$description</p>
				   </div>
			   </div>

			   <div class='row'>
					<div class='col-12of12'>
							<h3 class='cat'>show info</h3>
					</div>
				</div>


				<div class='row'>
					<div class='col-12of12'>
					  <div class='info'>
					  <p>Average rating: $avg_rating</p>
					   <p>Airing date: $airing_date</p>
					   <p>Status: $status</p>
             <p>Genre: $genres</p>
				   </div>
			   </div>




		    </div>

	    </div>
	   </div>


    ";
/*
    echo "<h1>$show_name</h1>";
    echo "<p>$name_jp</p>";
*/
 /*
   echo "<p>Airing date: $airing_date</p>";
    echo "<p>Status: $status</p>";
    echo "<p>Average rating: $avg_rating</p>";

*/
    echo "​<iframe width=\"560\" height=\"315\" src=\"" . $anime_trailer . "\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>";
  }

  $show_stmt->free_result();
  $show_stmt->close();


  $episodes_query = "SELECT DISTINCT episode_num "
                  . "FROM links "
                  . "WHERE show_id = ? "
                  . "ORDER BY episode_num";
  $episodes_stmt = $db->prepare($episodes_query);
  $episodes_stmt->bind_param('i', $show_id);
  $episodes_stmt->execute();
  $episodes_stmt->bind_result($episode_num);
  $episodes_stmt->store_result();


  echo "
   <div class='col-9of12'>
   	<div class='row'>
   		<div class='col-12of12'>
			  <h3 class='cat'>videos ($episodes_stmt->num_rows)</h3>
		  </div>
	  </div>
	  <div class='row'>
  ";

  while ($episodes_stmt->fetch()) {
    display_video_card($show_id, $show_name, $episode_num, $show_img);
  }

	echo "
		</div>
		</div>
	</div>
	";


  $episodes_stmt->free_result();
  $episodes_stmt->close();

  $db->close();

?>