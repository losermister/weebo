<?php

  require('helper/functions.php');
  use_http();
  require('helper/header.php');

  // Store show ID and episode number from GET method, if valid
  if (isset($_GET['show']) && check_shows_list($_GET['show'], $db)) {
    $show_id = $_GET['show'];
    $show_name = showname_from_id($show_id, $db);

    if (isset($_GET['ep']) && check_episodes_list($_GET['ep'], $_GET['show'], $db)) {
      $current_episode = $_GET['ep'];
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

  if (isset($_SESSION['valid_user'])) {
    $email = $_SESSION['valid_user'];
  }

  $episode_query = "SELECT video_url "
                 . "FROM links "
                 . "WHERE show_id = ? AND episode_num = ? "
                 . "ORDER BY episode_num";
  $episode_stmt = $db->prepare($episode_query);
  $episode_stmt->bind_param('ii', $show_id, $current_episode);
  $episode_stmt->execute();
  $episode_stmt->bind_result($video_url);

	echo "<div class='container'>";
  echo "<div class='col-9of12'>";
  while ($episode_stmt->fetch()) {
    echo "<iframe class='vid' src='$video_url' allowfullscreen></iframe>";
  }

  echo "<h2><a href='show.php?id=$show_id'>$show_name</a> - Episode $current_episode</h2>";

  $episode_stmt->free_result();
  $episode_stmt->close();

  $num_comments = get_num_comments($video_url, $db);

  echo "<section class='comments'>";
  echo "<h3 id='comment-counter'>" . $num_comments . " Comments</h3>";
  echo "<div class='post-comments-container'>";

  if (isset($_SESSION['valid_user'])) {

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

  } else {
    echo "<p class='sign-in-comment'>Please <a href='login.php'> sign in </a> to comment on this episode!</p>";
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

  $res = $comments_stmt->get_result();

  while ($row = $res->fetch_row()) {
    $all_comments[] = $row;
  }

  $comments_stmt->store_result();
  $comments_stmt->free_result();
  $comments_stmt->close();

  for ($i = 0; $i < $num_comments; $i++) {
    display_comment($all_comments[$i][0], $all_comments[$i][1], $all_comments[$i][2], $all_comments[$i][3]);
  }

  echo "</section>";
  echo "</div>";
  echo "</div>";


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

    $episodes_query = "SELECT DISTINCT episode_num "
                    . "FROM links "
                    . "WHERE show_id = ? "
                    . "ORDER BY episode_num ASC";
    $episodes_stmt = $db->prepare($episodes_query);
    $episodes_stmt->bind_param('i', $show_id);
    $episodes_stmt->execute();
    $episodes_stmt->bind_result($episode_num);
    $episodes_stmt->store_result();

    echo "<div class='col-3of12'>";
    echo "<h3>videos</h3>";

    while ($episodes_stmt->fetch()) {
      display_upcoming_list($show_id, $results['show_name'], $current_episode, $episode_num, $results['show_img']);
    }

    echo "</div>";
    echo "</div>";

    $db->close();
  }

  require('helper/footer.php');
?>

<script type='text/javascript'>
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