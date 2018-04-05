
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

  $email = '';

  if (isset($_SESSION['valid_user'])) {
    $email = $_SESSION['valid_user'];

    if (isset($_POST['rating'])) {
      $rating = $_POST['rating'];
      update_rating($email, $show_id, $rating, $db);
      display_notification_success("Thanks for rating " . showname_from_id($show_id, $db) . "!");
    }
  }

  $genres = implode(', ', genres_list_from_id($show_id, $db));

  $avg_rating = (avg_show_rating($show_id, $db));

  $show_query = "SELECT name, bg_img, description, banner_img, anime_trailer, name_jp, status, airing_date, avg_rating "
              . "FROM shows "
              . "WHERE show_id = ?";
  $show_stmt = $db->prepare($show_query);
  $show_stmt->bind_param('i', $show_id);
  $show_stmt->execute();
  $show_stmt->bind_result($show_name, $show_img, $description, $banner_img, $anime_trailer, $name_jp, $status, $airing_date, $avg_rating);
  $result = $show_stmt->get_result();
  $show_stmt->free_result();
  $show_stmt->close();

  $results_keys = array('show_name', 'show_img', 'description', 'banner_img', 'anime_trailer', 'name_jp', 'status', 'airing_date', 'avg_rating');

  while ($row = $result->fetch_array(MYSQLI_NUM)) {

    $results = array_combine($results_keys, $row);

    echo "
   	<div class='banner-container'>
  	 	<div class='container'>
  	 		<div class='banner-details'>
  				<div class='col-6of12'>
  					<h2>". $results['show_name'] ."</h2>
  					<p>". $results['name_jp'] ."</p>
  					<form action='favourites.php' class='save-btn' method='post'>";
              if (in_favourites_list($email, $show_id, $db)) {
                echo "<input type='hidden' name='unfavourite_show' value='$show_id'>
                <button type='submit' class='bkmrk-state btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-check'></span>saved</button>";
              } else {
                  echo "<input type='hidden' name='favourite_show' value='$show_id'>
                  <button type='submit' class='btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-heart'></span>favourite</button>";
              }
            echo "</form>
  				</div>
  			</div>
	 	  </div>
      <div class='banner-overlay'></div>
  		<div class='banner-img-container'>
  			<div class='show-img' style='background-image:url(\"" . $results['banner_img'] . "\")'></div>
  		</div>
    </div>";

    echo "
    <div class='container'>
	    <div class='col-3of12'>
				<div class='row'>
					<div class='col-12of12'>
							<h3 class='cat'>trailer</h3>
					</div>
				</div>
				<iframe class='trailer' src=\"" . $results['anime_trailer'] . "\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>
			  <div class='row'>
				  <div class='col-12of12'>
						<h3 class='cat'>sypnosis</h3>
			 	  </div>
			  </div>
				<div class='row'>
					<div class='col-12of12'>
					  <div class='info'>
					 <p class='descript'>" . $results['description'] . "</p>
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
  					  <h4>Average rating:</h4>
  					  <p>" . number_format($avg_rating * 10, 2) . "</p>";

              if (isset($_SESSION['valid_user'])) {
                echo "<form action='show.php?id=$show_id' id='rate' method ='post'>";
                add_dropdown_num_range('rating', 1, 10);
                echo "<button type='submit' form ='rate' value ='Submit' class='btn-small'>Rate</button>
                </form>";
              }

  					  echo "
              <h4>Airing date:</h4>
					    <p>" . $results['airing_date'] . "</p>
					    <h4>Status:</h4>
					    <p>" . $results['status'] . "</p>
					    <h4>Genre:</h4>
              <p><a href='#'>$genres</a></p>
			      </div>
		      </div>
	      </div>
      </div>
    </div>";

    $episodes_query = "SELECT DISTINCT episode_num "
                    . "FROM links "
                    . "WHERE show_id = ? "
                    . "ORDER BY episode_num DESC";
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
	    <div class='row'>";

        while ($episodes_stmt->fetch()) {
          display_video_card($show_id, $results['show_name'], $episode_num, $results['show_img']);
        }

      	echo "
      	</div>
    	</div>
  	</div>";

    $episodes_stmt->free_result();
    $episodes_stmt->close();
    $db->close();
  }
?>

<script>
  $(document).ready(function(){
    var textHtml = $(".descript").html();
    var lessText = textHtml.substr(0,200);

    if(textHtml.length > 255){
      $(".descript").html(lessText).append("...<a href='' class='read-more'>Show More</a>");
    }
    else{
      $(".descript").html(textHtml);
    }

    $("body").on("click",".read-more", function(event){
      event.preventDefault();
      $(this).parent(".descript").html(textHtml).append("<a href='' class='read-less'>Show Less</a>");

    });

    $("body").on("click",".read-less", function(){
      event.preventDefault();
      $(this).parent(".descript").html(textHtml.substr(0,200)).append("...<a href='' class='read-more'>Show More</a>");
    });

  });
</script>
