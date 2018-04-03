<?php

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store show ID and episode number from GET method, if valid
  if (isset($_GET['show']) && check_shows_list($_GET['show'], $db)) {
    $show_id = $_GET['show'];
    $show_name = showname_from_id($show_id, $db);

    if (isset($_GET['ep']) && check_episodes_list($_GET['ep'], $_GET['show'], $db)) {
      $ep_num = $_GET['ep'];
    } else {
      echo "Sorry! We couldn't find that video. ";
      echo "<a href=\"show.php?id=$show_id\">Back to $show_name</a>";
      exit;
    }

  } else {
    echo "Oops! We couldn't find that video. ";
    echo "<a href=\"index.php\">Back to homepage</a>";
    exit;
  }

  $episode_query = "SELECT video_url "
                 . "FROM links "
                 . "WHERE show_id = ? AND episode_num = ? "
                 . "ORDER BY episode_num";
  $episode_stmt = $db->prepare($episode_query);
  $episode_stmt->bind_param('ii', $show_id, $ep_num);
  $episode_stmt->execute();
  $episode_stmt->bind_result($video_url);

	echo "<div class='container'>";

  while ($episode_stmt->fetch()) {
    echo "<iframe class='vid' src='$video_url' ></iframe>";
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment_body = trim($_POST['comment']);
    $email = $_SESSION['valid_user'];
    post_comment($email, $video_url, $comment_body, $db);
  }

  echo "<h2><a href='show.php?id=$show_id'>$show_name</a> - Episode $ep_num</h2>";
	echo "</div>";

  $episode_stmt->free_result();
  $episode_stmt->close();

  echo "<h3>Comments</h3>";

  // TODO: Structure + style the comment form and login message
  if (isset($_SESSION['valid_user'])) {
    echo "<form action=\"watch.php?show=$show_id&ep=$ep_num\" method=\"post\">";
    echo "<fieldset>";
    echo "<legend>Leave a comment</legend>";
    echo "<textarea name='comment' rows='4' cols='50' placeholder='Type your comment...'></textarea>";
    echo "</fieldset>";
    echo "<input type=\"submit\" name=\"submit-comment\" value=\"add comment\">";
    echo "</form>";
  } else {
    echo "Please <a href='login.php'> sign in </a> to comment on this episode!";
  }

  $comments_query = "SELECT users.user_id, users.profile_img, comment_body, date_added "
                  . "FROM comments "
                  . "INNER JOIN users ON comments.email = users.email "
                  . "WHERE video_url = ? "
                  . "ORDER BY date_added DESC";
  $comments_stmt = $db->prepare($comments_query);
  $comments_stmt->bind_param('s', $video_url);
  $comments_stmt->execute();
  $comments_stmt->bind_result($username, $avatar, $comment, $date);

  while ($comments_stmt->fetch()) {
    // TODO: Structure + style each comment
    echo $username;
    echo "<img src=" . $avatar . ">";
    echo $comment;
    echo $date;
    echo "<br>";
  }

  $db->close();

?>