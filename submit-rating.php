<?php

  //=================================================================================
  // submit-rating.php
  //
  // Script for submitting/updating a user's rating on an episode
  //=================================================================================

	require('helper/functions.php');

  // Store all values from Ajax call
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['username'])) {
			$username = $_POST['username'];
      $email = email_from_username($username, $db);
	  }
    if (!empty($_POST['show_name'])) {
      $show_name = $_POST['show_name'];
      $show_id = showid_from_name($show_name, $db);
    }
    if (!empty($_POST['rating'])) {
      $rating = $_POST['rating'];

      // Add rating to the DB
      update_rating($email, $show_id, $rating, $db);
      display_notification_success("Thanks for rating $show_name!");

    } else {
      // Show error message if no rating given
      display_notification_error("Please give $show_name a rating out of 10!");
    }

    // Get the new average rating, then format and display it
    $avg_rating = (avg_show_rating($show_id, $db));
    echo "<p>" . number_format($avg_rating * 10, 1) . "</p>";

    // Display rating form if user is logged in
    if (isset($_SESSION['valid_user'])) {
      echo "<form action='show.php?id=$show_id' id='rate' method ='post'>";
      add_dropdown_num_range('rating', 1, 10);
      echo "<button type='submit' id='submit-rating' form ='rate' value ='Submit' class='btn-small'>Rate</button>
      </form>";
    }

    // Display the user's last rating for the show
    display_user_rating_for_show($email, $show_id, $db);
	}

?>

<script type='text/javascript'>
  // Ajax call when clicking on submit button to dynamically update the show's average rating
  // and display the user's latest rating
  $('#submit-rating').click(function() {
    event.preventDefault();
    var username = $('#user-click').text()
    var show_name = $('h2').first().text()
    console.log($('#rate').serialize() + "&username=" + username + "&show_name=" + show_name)
    $.ajax({
      type: 'POST',
      url:  'submit-rating.php',
      data: $('#rate').serialize() + "&username=" + username + "&show_name=" + show_name,
      success:function(html) {
        $('#display-rating').html(html).hide().fadeIn('fast');
      }
    });
  });
</script>