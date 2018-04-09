<?php
	require('helper/functions.php');
	use_http();
  require('helper/header.php');
?>

	<div class="container content">
		<h1>All Shows</h1>
		<div class="row">
			<div class="col-3of12">
				<form class="filter-form">
					<?php
						echo "<div class='checkbox-header'>Airing year</div>";
						add_dropdown_filter('All years', 'filter-by-year', all_years_list($db), all_years_list($db));
						echo "<div class='checkbox-header'>genre</div>";
						add_checklist('filter-by-multi-genre[]', all_genres_list($db), all_genres_list($db));
					?>
				</form>
			</div>
			<div class="col-9of12" id="show-data">
				<div class="loading-overlay" style="display: none; color: white;">
					<span class="overlay-content">Loading...</span>
				</div>
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
	</div>

<script type='text/javascript'>
	$('[id^=filter]').change(function() {
		$('[id^=filter]').each(function() {
			console.log($('.filter-form').serialize())
			getShows()
		});
	});

	function getShows() {
		$.ajax({
			type: 'POST',
			url:  'get-shows.php',
			data: $('.filter-form').serialize(),
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
