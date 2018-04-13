<?php
	require('helper/functions.php');
	use_http();
?>

			<?php
	      if (isset($_SESSION['valid_user'])) {
	      	$email = $_SESSION['valid_user'];
	      } else {
	      	$_SESSION['require_login'] = 'You need to be logged in to do that!';
	      	header('Location: login.php');
	      }

  			require('helper/header.php');
			  echo "<div class='container content'>";
		    echo "<h1>My Favourite Shows</h1>";
		    echo "<div class='row display-favs'>";

				$shows_query = "SELECT avg(rating) as avg_rating, favourite_shows.show_id, shows.name, shows.bg_img "
				             . "FROM favourite_shows "
				             . "INNER JOIN shows ON favourite_shows.show_id = shows.show_id "
				             . "INNER JOIN oso_user_ratings ON favourite_shows.show_id = oso_user_ratings.show_id "
				             . "WHERE favourite_shows.email = ? "
				             . "GROUP BY oso_user_ratings.show_id";

				$shows_stmt = $db->prepare($shows_query);
				$shows_stmt->bind_param('s', $email);
				$shows_stmt->execute();
				$shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);
				$result = $shows_stmt->get_result();
				$shows_stmt->store_result();
				$shows_stmt->free_result();
			  $shows_stmt->close();

			  $all_favourites_results = array();

				while ($row = $result->fetch_array(MYSQLI_NUM)) {
				  $all_favourites_results[] = $row;
				  display_show_card($row[0], $row[1], $row[2], $row[3], $db);
				}

				$num_favourites = sizeof($all_favourites_results);

				if ($num_favourites <= 0) {
					echo "<p>You haven't favourited any shows yet.</p>";
				}

			?>
		</div>
	</div>
</div>

<?php
	require('helper/footer.php');
?>

<script type='text/javascript'>

	$(function() {

	function updateFavs() {
		event.preventDefault();
		var show_id = $(this).closest('.show-info').attr('data-show-id')
		var username = $('#user-click').text()

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
		// console.log($(this).closest('.show-info').attr('data-show-id'))
		// console.log(username)
		// console.log(action)

    $.ajax({
      type: 'POST',
      url:  'update-favourite.php',
      data: { show_id : show_id, action : action, username : username },
      success:function(html) {
		     $('.display-favs').load(
		     	document.URL +  ' .display-favs',
		     	function() {
		     		$('.save').off();
		     		addClickHandler();
		     	})
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

	function addClickHandler() {
		$('.save').click(updateFavs);
	}

	addClickHandler();

});


</script>