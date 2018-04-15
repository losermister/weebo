<?php

  //=============================================================================
  // show.php
  //
  // Display details for each show (from its id in the URL):
  //   - Banner (name, Japanese name, banner image, favourite button)
  //   - Trailer video embedded in sidebar
  //   - Synopsis description in sidebar
  //   - Show info (average rating, user rating, airing date, status, genres)
  //=============================================================================

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

  // Identify the user by email if logged in
  if (isset($_SESSION['valid_user'])) {
    $email = $_SESSION['valid_user'];
  } else {
    $email = '';
  }

  // Get the list of genres and average rating for the show
  $genres = genres_list_from_id($show_id, $db);
  $avg_rating = (avg_show_rating($show_id, $db));

  // Get all other show info from its entry in the shows table in DB
  $show_query = "SELECT name, bg_img, description, banner_img, anime_trailer, name_jp, status, airing_date, avg_rating "
              . "FROM shows "
              . "WHERE show_id = ?";

  $show_stmt = $db->prepare($show_query);
  $show_stmt->bind_param('i', $show_id);
  $show_stmt->execute();
  $result = $show_stmt->get_result();
  $show_stmt->free_result();
  $show_stmt->close();

  $results_keys = array('show_name', 'show_img', 'description', 'banner_img', 'anime_trailer', 'name_jp', 'status', 'airing_date', 'avg_rating');

  while ($row = $result->fetch_array(MYSQLI_NUM)) {

    $results = array_combine($results_keys, $row);
    display_show_banner($show_id, $results['show_name'], $results['name_jp'], $results['banner_img'], $email, $db);

    echo "
    <div class='container'>

	    <div class='col-3of12'>";
        // Display all show information in the sidebar
        display_show_trailer('Trailer', $results['anime_trailer']);
        display_show_synopsis('Synopsis', $results['description']);
        display_show_info('Show Info', $avg_rating, $show_id, $email, $results['airing_date'], $results['status'], $genres, $db);
      echo "
      </div>

      <div class='col-9of12'>";
        // Display all available videos for the show
        display_all_videos('Videos', $show_id, $results['show_name'], $results['show_img'], $db);
      echo
      "</div>

    </div>";
  }

  require('helper/footer.php');
?>

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

  // Submitting a rating will display a confirmation/error message (if no rating was entered)
  // Ajax call adds/removes the user's rating in DB, updates the average rating and user's last rating
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

  $(document).ready(function() {
    var textHtml = $(".descript").html();
    var lessText = textHtml.substr(0,200);

    if (textHtml.length > 255) {
      $(".descript").html(lessText).append("...<a href='' class='read-more'>Show More</a>");
    } else {
      $(".descript").html(textHtml);
    }

    $("body").on("click",".read-more", function(event) {
      event.preventDefault();
      $(this).parent(".descript").html(textHtml).append("<a href='' class='read-less'>Show Less</a>").hide().fadeIn('fast');
    });

    $("body").on("click",".read-less", function() {
      event.preventDefault();
      $(this).parent(".descript").html(textHtml.substr(0,200)).append("...<a href='' class='read-more'>Show More</a>");
    });
  });

</script>
