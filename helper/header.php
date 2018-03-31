<!DOCTYPE html>
<html lang="en">

<head>
	<link href="css/main.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

	<nav>
		<div class="container">

			<div class="row">

				<ul class="fl-left">
					<a href="index.php"><li id="logo">weebflix</li></a>
				</ul>


				<ul class="fl-left">
		<!--
			<a href="#"><li>anime shows</li></a>
					<a href="#"><li>movies</li></a>
					<a href="#"><li>categories</li></a>
-->

					
					
			<!-- 		<a href="#"><li>movies</li></a> -->

	<!-- 				<a href="#"><li>categories</li></a> -->

				</ul>
				<ul class="fl-right">
					<a href="all-shows.php"><li>all shows</li></a>
					<a href="favourites.php"><li>favourites</li></a>
					<?php
	          if (isset($_SESSION['valid_user'])) {
	          	$username = username_from_email($db);
	          	
	        /* href=\"user.php?id=$username\" */
	            echo "<a id='user-click'><li class='user-act'>$username <span class='fas fa-caret-down'></span></li></a>";
	      
							echo "<div class='user-dropdown'>";
							echo "<a href=\"user.php?id=$username\"><span class='fas fa-user'></span> my profile</a>";
							echo "<a href=\"edit-profile.php\"><span class='fas fa-wrench'></span> Edit profile</a>";
	            echo "<a href=\"logout.php\"><span class='fas fa-sign-out-alt'></span> Logout</a>";
							echo "</div>";
	            
	            
	          } else {
	            echo "<a href=\"login.php\"><li>sign up/login</li></a>";
	          }
			    ?>

					<script>
						$('#user-click').click(function(){
					
							$('.user-dropdown').toggle();
						});
					
					</script>


<!--
					<a href="#"><li class="fas fa-bookmark">
						<span class="added-items">1</span>

					</li></a>
-->
					<!-- <a href="#" ><li class="fas fa-search"></li></a> -->
				<!--
	<li><form action="" method="get" placeholder="search "value="">
					<input type="search" placeholder="Start your search" name="searchQuery" >
					</form></li>
-->
				<!--
	<a href="#" ><li class="fas fa-ellipsis-v">

-->


<!--
						<span class="items">
							<p>You're not logged in</p>

						</span>
-->


				</ul>

			</div>
		</div>


	</nav>

		<div class="nav-space"></div>
