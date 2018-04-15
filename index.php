<?php

  //=============================================================================
  // index.php
  //
  // Displays the homepage:
  //   - Featured show (defined in helper/variables.php)
  //   - Recently uploaded videos in the sidebar
  //   - Recommendations (logged in) OR Top Rated (guest OR no shows rated yet)
  //=============================================================================

	require('helper/functions.php');
	use_http();
  require('helper/header.php');

  // Identify the user by email if logged in
  if (isset($_SESSION['valid_user'])) {
    $email = $_SESSION['valid_user'];
  } else {
  	$email = "";
  }

  // If the user just logged out, display message and destroy session
	if (isset($_SESSION['logout'])) {
		display_notification_success($_SESSION['logout']);
		session_destroy();
	}

	// Display the featured show in the banner
	$heading = 'Staff pick';
	$short_description = 'During her family\'s move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches, and spirits, and where humans are changed into beasts.';
	display_featured_show($featured_show_id, $heading, $short_description, $email, $db);

?>

	<div class="container content">
		<div class="row content" >
			<div class="col-3of12">
				<div class="row">
					<div class="col-12of12">
						<h3 class="cat">Recent Uploads</h3>
					</div>
				</div>
				<div class="row">
					<?php
						// Get the 10 most recent episodes and display as a list
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
							display_episodes_list($show_id, $show_name, $episode_num, $show_img);
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
							// If user is logged in and has rated at least one show
							if (isset($_SESSION['valid_user']) && sizeof(rated_shows_list($email, $db)) >= 1) {
								echo "<h3 class=\"cat\">Recommended for you</h3>";
								echo "
					</div>
				<div class='row'>";
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

					// Display the top rated shows if not logged in, or no shows rated yet
					echo "<h3 class=\"cat\">Top rated</h3>";
					echo "
					</div>

				<div class='row'>";
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
</div>

<?php require('helper/footer.php'); ?>

<script type='text/javascript'>

	// Clicking the Favourite button on the banner changes the style and adds pulse animation
	// depending if the show has been favourited by the user already.
	// Ajax call adds/removes to the user's favourites list and update favourites count in the header
	$('.btn-secondary').click(function() {
		var show_id = $('h2').attr('data-show-id')
		var username = $('#user-click').text()

    if (username !== '') {
      event.preventDefault();

			if (!$(this).hasClass('bkmrk-state')) {
				$(this).addClass('bkmrk-state animated pulse')
				$(this).children().removeClass('fa-heart animated pulse')
				$(this).children().addClass('fa-check')
				var action = 'add'
			} else {
				$(this).removeClass('bkmrk-state animated pulse')
				$(this).children().removeClass('fa-check')
				$(this).children().addClass('fa-heart animated pulse')
				var action = 'remove'
			}

	    $.ajax({
	      type: 'POST',
	      url:  'update-favourite.php',
	      data: { show_id : show_id, action : action, username : username },
	      success:function(html) {
	        $('.fvr-lnk a span').html(html)
	        $('.fvr-lnk a span').animate({
			      top: "-5"
			    }, {
			      queue: false,
			      duration: 200
			    })
			    .animate({ top: "0" }, 100 );
	      }
	    });
  	}
	});

	// Clicking the Favourite buttons on the show cards the style and adds pulse animation
	// depending if the show has been favourited by the user already.
	// Ajax call adds/removes to the user's favourites list and update favourites count in the header
	$('.save').click(function() {
		var show_id = $(this).closest('.show-info').attr('data-show-id')
		var username = $('#user-click').text()

		if (username !== '') {
			event.preventDefault();

			if (!$(this).hasClass('saved-state')) {
				$(this).addClass('saved-state animated bounceIn')
				$(this).children().removeClass('fa-heart animated bounceIn')
				$(this).children().addClass('fa-check')
				var action = 'add'
			} else {
				$(this).removeClass('saved-state animated bounceIn')
				$(this).children().removeClass('fa-check')
				$(this).children().addClass('fa-heart animated bounceIn')
				var action = 'remove'
			}

	    $.ajax({
	      type: 'POST',
	      url:  'update-favourite.php',
	      data: { show_id : show_id, action : action, username : username },
	      success:function(html) {
	        $('.fvr-lnk a span').html(html)
	        $('.fvr-lnk a span').animate({
			      top: "-5"
			    }, {
			      queue: false,
			      duration: 200
			    })
			    .animate({ top: "0" }, 100 );
	      }
	    });
	  }
	});

</script>
