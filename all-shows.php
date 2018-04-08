<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>

	<div class="container content">
		<h1>All Shows</h1>
			<?php add_dropdown('filter by genre', 'filter-by-genre', all_genres_list($db), all_genres_list($db)); ?>
			<div class="loading-overlay" style="display: none; color: white;">
				<span class="overlay-content">Loading...</span>
			</div>
		<div class="row" id="show-data">
			<?php
				$shows_query = "SELECT avg(rating) as avg_rating, shows.show_id, shows.name, shows.bg_img "
				             . "FROM oso_user_ratings "
				             . "INNER JOIN shows ON shows.show_id = oso_user_ratings.show_id "
				             . "GROUP BY oso_user_ratings.show_id "
				             . "ORDER BY shows.show_id";

				$shows_stmt = $db->prepare($shows_query);
				$shows_stmt->execute();

				$shows_stmt->bind_result($avg_rating, $show_id, $show_name, $show_img);
				$shows_stmt->store_result();

				while ($shows_stmt->fetch()) {
					display_show_card($avg_rating, $show_id, $show_name, $show_img, $db);
				}

				$shows_stmt->free_result();
			 	$shows_stmt->close();

			?>
		</div>
	</div>

<script type='text/javascript'>
	$('#filter-by-genre').change(function() {
		getShows('filter', $(this).val())
	});

	function getShows(type, val) {
		$.ajax({
			type: 'POST',
			url:  'get-shows.php',
			data: 'type='+type+'&val='+val,
			beforeSend:function(html) {
				$('.loading-overlay').show();
			},
			success:function(html) {
				$('.loading-overlay').hide();
				$('#show-data').html(html);
			}
		});
	}
</script>

<?php
	require('helper/footer.php');
?>
