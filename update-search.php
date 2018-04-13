<?php
	require('helper/functions.php');
	
	$term = mysqli_real_escape_string($db, $_REQUEST['term']);
	$shows_query = "SELECT shows.show_id, shows.name, shows.bg_img "
	         . "FROM shows ";
	         . "WHERE show.name LIKE '".$term."%'" ;
	
	$shows_stmt = $db->prepare($shows_query);
	$shows_stmt->execute();
	$shows_stmt->bind_result($show_id, $show_name, $show_img);
	$shows_stmt->store_result();
	
	
		
		while ($shows_stmt->fetch()) {
			display_search_list($show_id, $show_name, $show_img);
		}
		
			$shows_stmt->free_result();
			$shows_stmt->close();
		}
?>