<?php

	require('helper/functions.php');

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

      update_rating($email, $show_id, $rating, $db);
      display_notification_success("Thanks for rating $show_name!");

    } else {
      display_notification_error("Please give $show_name a rating out of 10!");
    }

    $avg_rating = (avg_show_rating($show_id, $db));

    echo "<p>" . number_format($avg_rating * 10, 2) . "</p>";

    if (isset($_SESSION['valid_user'])) {
      echo "<form action='show.php?id=$show_id' id='rate' method ='post'>";
      add_dropdown_num_range('rating', 1, 10);
      echo "<button type='submit' id='submit-rating' form ='rate' value ='Submit' class='btn-small'>Rate</button>
      </form>";
    }

    get_user_rating_for_show($email, $show_id, $db);

	}

?>

<script type='text/javascript'>
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

<?php
	require('helper/footer.php');
?>