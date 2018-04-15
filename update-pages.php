<?php

  //=====================================================================================
  // update-pages.php
  //
  // Script for updating the page navigation displayed when filtering in all-shows.php
  // Shows the updated total number of pages and resets the current page to 1
  //=====================================================================================

	$filtered_year = '';
	$filtered_genres = '';
	$num_filtered_genres = 0;
	$filtered_status = '';

	require('helper/functions.php');

	// Store all values from Ajax call
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['filter-by-year'])) {
			$filtered_year = $_POST['filter-by-year'];
	  }
		if (!empty($_POST['filter-by-status'])) {
			$filtered_status = $_POST['filter-by-status'];
	  }
	  if (!empty($_POST['filter-by-multi-genre'])) {
			$num_filtered_genres = count($_POST['filter-by-multi-genre']);
			$filtered_genres = $_POST['filter-by-multi-genre'];
	  }
		if (!empty($_POST['page'])) {
			$current_page = $_POST['page'];
	  }
		if (!empty($_POST['curpage'])) {
			$current_page = $_POST['curpage'];
	  }
	}

	// Construct the base query
	$shows_query = "SELECT avg_show_rating AS 'avg_rating', shows.show_id, shows.name, shows.bg_img "
	             . "FROM shows "
	             . "JOIN ( SELECT shows.show_id AS show_id, AVG(rating) AS avg_show_rating "
	             . "       FROM oso_user_ratings "
	             . "       INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
	             . "       GROUP BY shows.show_id "
	             . "      ) AS avg_finder ON shows.show_id = avg_finder.show_id "
	             . "INNER JOIN genres on shows.show_id = genres.show_id ";

	// If a year is specified, add to the query
	if (!empty($_POST['filter-by-year']) && $filtered_year != 'All') {
	 	$shows_query .= "WHERE YEAR (airing_date) = $filtered_year ";
	}

	// If genre(s) are specified, add to the query
	if (!empty($_POST['filter-by-multi-genre'])) {
		for($i = 0; $i < $num_filtered_genres; $i++) {
			if ($i == 0) {
				$shows_query .= "AND (genres.genre = '$filtered_genres[$i]' ";
				if ($num_filtered_genres <= 1) {
					$shows_query .= ") ";
				}
			} else {
				$shows_query .= "OR genres.genre = '$filtered_genres[$i]' ";
				if ($i == $num_filtered_genres-1) {
					$shows_query .= ") ";
				}
			}
		}
	}

	// If a status is specified, add to the query
	if (!empty($_POST['filter-by-status']) && $filtered_status != 'All') {
	 	$shows_query .= "AND shows.status = '$filtered_status' ";
	}

	$shows_query .= "GROUP BY shows.show_id ";
	$shows_query .= "ORDER BY shows.show_id";

	$res = $db->query($shows_query);

	while ($row = $res->fetch_row()) {
		 $all_show_results[] = $row;
	}

	// Get the right values for pagination
	$num_items = $res->num_rows;
	$pages = ceil($num_items / $items_per_page);

	// Update the page navigation with new total page count
	// Reset current page number to 1
	add_page_nav(1, $pages, 'page-nav');

?>

<script type='text/javascript'>

	// Clicking the Favourite buttons on the show cards the style and adds pulse animation
	// depending if the show has been favourited by the user already.
	// Ajax call adds/removes to the user's favourites list and update favourites count in the header
	function updateFavs() {
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
			console.log($(this).closest('.show-info').attr('data-show-id'))
			console.log(username)
			console.log(action)

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
	}

	function addClickHandler() {
		$('.save').click(updateFavs);
	}

	addClickHandler();

	$('[id=filter-page]').change(function() {
		getShows()
		console.log($('.browse-form').serialize())
	});

	function resetPage() {
		$.ajax({
			type: 'POST',
			url:  'update-pages.php',
			data: $('.browse-form').serialize() + "&curpage=" + 1,
			success:function(html) {
				$('#show-page-nav').html(html);
				// $('#show-page-nav').html(html);
				$('.save').off();
     		addClickHandler();
			}
		});
	}

	function getShows() {
		$.ajax({
			type: 'POST',
			url:  'get-shows.php',
			data: $('.browse-form').serialize(),
			beforeSend:function(html) {
				$('.loading-overlay').show();
			},
			success:function(html) {
				$('.loading-overlay').hide();
				$('#show-data').html(html).hide().fadeIn('fast');
				// $('#show-page-nav').html(html);
				$('.save').off();
     		addClickHandler();
			}
		});
	}

	function updatePages() {
		console.log('updatepages')
		$.ajax({
			type: 'POST',
			url:  'get-shows.php',
			data: $('.browse-form').serialize() + "&curpage=" + 1,
			beforeSend:function(html) {
				$('.loading-overlay').show();
			},
			success:function(html) {
				$('.loading-overlay').hide();
				$('#show-data').html(html).hide().fadeIn('fast');
				// $('#show-page-nav').html(html);
				$('.save').off();
     		addClickHandler();
			}
		});
	}

</script>

<?php
	require('helper/footer.php');
?>