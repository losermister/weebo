<?php
	$comment_text = '';

	require('helper/functions.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['username'])) {
			$username = $_POST['username'];
	  }
		if (!empty($_POST['comment_text'])) {
			$comment_text = trim($_POST['comment_text']);
	  }
		if (!empty($_POST['video_url'])) {
			$video_url = $_POST['video_url'];
	  }
	}

  $email = email_from_username($username, $db);

  post_comment($email, $video_url, $comment_text, $db);
  display_notification_success("Thanks for leaving a comment!");

  $num_comments = get_num_comments($video_url, $db);

  $comments_query = "SELECT users.user_id, users.profile_img, comment_body, date_added "
                  . "FROM comments "
                  . "INNER JOIN users ON comments.email = users.email "
                  . "WHERE video_url = ? "
                  . "ORDER BY date_added DESC";
  $comments_stmt = $db->prepare($comments_query);
  $comments_stmt->bind_param('s', $video_url);
  $comments_stmt->execute();
  $comments_stmt->bind_result($username, $avatar, $comment, $date);

  $res = $comments_stmt->get_result();

  while ($row = $res->fetch_row()) {
    $all_comments[] = $row;
  }

  echo "<h3 id='comment-counter'>" . $num_comments . " Comments</h3>";
  echo "<div class='post-comments-container'>";

  echo "<div class='row'>";
  echo "<div class='col-1of12'>";
  echo "<img src='".avatar_from_email($db)."'>";
  echo "</div>";
  echo "<div class='col-11of12'>";
  // echo "<form action=\"watch.php?show=$show_id&ep=$ep_num\" method=\"post\">";
  echo "<form class='comment-form'>";
  echo "<fieldset>";

  echo "<h3>Leave a comment</h3>";

  echo "<textarea id='comment-box' name='comment' rows='4' cols='50' placeholder='Type your comment...'></textarea>";
  echo "</fieldset>";
  echo "<input id='submit-comment' type=\"submit\" name=\"submit-comment\" value=\"comment\">";
  echo "</form>";
  echo "</div>";
  // echo "</div>";

  for ($i = 0; $i < $num_comments; $i++) {
    display_comment($all_comments[$i][0], $all_comments[$i][1], $all_comments[$i][2], $all_comments[$i][3]);
  }

  $comments_stmt->store_result();
  $comments_stmt->free_result();
  $comments_stmt->close();

	$db->close();

?>

<script type='text/javascript'>
  $('#submit-comment').click(function() {
    event.preventDefault();
    var posted_comment = $('#comment-box').val()
    var video_url = $('.vid').attr('src')
    var commenter_username = $('#user-click').text()
    console.log(posted_comment + video_url + commenter_username)
    $.ajax({
      type: 'POST',
      url:  'update-comments.php',
      data: { username : commenter_username, comment_text : posted_comment, video_url : video_url },
      success:function(html) {
        $('.comments').html(html).hide().fadeIn('fast');
      }
    });
  });
</script>

<?php
	require('helper/footer.php');
?>