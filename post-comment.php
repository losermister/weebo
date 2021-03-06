<?php

  //=================================================================================
  // post-comment.php
  //
  // Script for posting and updating the list of comments on an episode
  //=================================================================================

	$comment_text = '';

	require('helper/functions.php');

  // Store all values from Ajax call
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

  // Add the comment and display the appropriate confirmation/error message
  if ($comment_text == '') {
    display_notification_error("Please leave your comment before submitting!");
  } else {
    post_comment($email, $video_url, $comment_text, $db);
    display_notification_success("Thanks for leaving a comment!");
  }

  $num_comments = get_num_comments($video_url, $db);

  // Get the updated list of comments
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

  // Display the updated number of comments on the episode
  echo "<h3 id='comment-counter'>" . $num_comments . " Comments</h3>";
  echo "<div class='post-comments-container'>";

  // Display the comment form
  echo "<div class='row'>";
  echo "<div class='col-1of12'>";
  echo "<img src='".avatar_from_email($db)."'>";
  echo "</div>";
  echo "<div class='col-11of12'>";
  echo "<form class='comment-form'>";
  echo "<fieldset>";

  echo "<h3>Leave a comment</h3>";

  echo "<textarea id='comment-box' name='comment' rows='4' cols='50' placeholder='Type your comment...'></textarea>";
  echo "</fieldset>";
  echo "<input id='submit-comment' type=\"submit\" name=\"submit-comment\" value=\"comment\">";
  echo "</form>";
  echo "</div>";

  // Display the updated list of all comments on the episode
  for ($i = 0; $i < $num_comments; $i++) {
    display_comment($all_comments[$i][0], $all_comments[$i][1], $all_comments[$i][2], $all_comments[$i][3]);
  }

  $comments_stmt->store_result();
  $comments_stmt->free_result();
  $comments_stmt->close();

	$db->close();

?>

<script type='text/javascript'>
  // Ajax call when clicking on submit button to dynamically update comments section
  $('#submit-comment').click(function() {
    event.preventDefault();
    var posted_comment = $('#comment-box').val()
    var video_url = $('.vid').attr('src')
    var commenter_username = $('#user-click').text()
    var num_comments = $('#comment-counter').text()
    console.log(posted_comment + video_url + commenter_username)
    $.ajax({
      type: 'POST',
      url:  'post-comment.php',
      data: { username : commenter_username, comment_text : posted_comment, video_url : video_url },
      success:function(html) {
        $('.comments').html(html).hide().fadeIn('fast');
      }
    });
  });
</script>