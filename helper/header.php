<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Weebflix</title>
	<link href="css/main.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
	<nav>
		<div class="container">
			<div class="row">
				<ul class="fl-left">
					<li id="logo"><a href="index.php">weebflix</a></li>
				</ul>
				<div class="fl-left search-show">
					<input type="text"  placeholder="Search for anime...">
					<div class="result"></div>
				</div>
				<ul class="fl-right">

					<li><a href="all-shows.php">Browse</a></li>

					<?php
						// Display navigation to Browse, Favourites, User Account (dropdown) / Login and Log out
	          if (isset($_SESSION['valid_user'])) {
	          	$username = username_from_email($db);
	          	$avatar = avatar_from_email($db);

	          	echo "<li class='fvr-lnk'><a href=\"favourites.php\" ><span>" . get_num_favourites($db) . "</span>Favourites</a></li>";

	            echo "<li class='user-act'><a id='user-click'><span class='avatar'><span class='avatar-img' style='background-image:url($avatar)'></span></span>$username <span class='fas fa-caret-down'></span></a></li>";

							echo "<div class='user-dropdown'>";
							echo "<a href=\"user.php?id=$username\">My Profile</a>";
							echo "<a href=\"edit-profile.php\">Edit profile</a>";
	            echo "<a href=\"logout.php\">Logout</a>";
							echo "</div>";

	          } else {
	            echo "<li><a href=\"login.php\">Sign up/Login</a></li>";
	          }
			    ?>

				</ul>
			</div>
		</div>
	</nav>
	<div class="nav-space"></div>
