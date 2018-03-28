<!DOCTYPE html>
<html lang="en">

<head>
	<link href="css/main.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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
					<a href="#"><li>all shows</li></a>
					<a href="#"><li>favourites</li></a>
			<!-- 		<a href="#"><li>movies</li></a> -->
	<!-- 				<a href="#"><li>categories</li></a> -->

					<?php
	          if (isset($_SESSION['valid_user'])) {
	          	$username = username_from_email($db);
	            echo "Welcome, <a href=\"user.php?id=$username\">$username</a>";
	            echo "<a href=\"edit-profile.php\">Edit profile</a>";
	            echo "<a href=\"logout.php\"><li>Logout</li></a>";
	          } else {
	            echo "<a href=\"login.php\"><li>sign up/login</li></a>";
	          }
			    ?>

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
