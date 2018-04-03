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
				<ul class="fl-left"></ul>
				<ul class="fl-right">
					<a href="all-shows.php"><li>all shows</li></a>
					<?php
	          if (isset($_SESSION['valid_user'])) {
	          	$username = username_from_email($db);
	          	$avatar = avatar_from_email($db);
	          	echo "<a href=\"favourites.php\"><li>favourites</li></a>";
	            echo "<a id='user-click'><li class='user-act'><span class='avatar'><span class='avatar-img' style='background-image:url($avatar)'></span></span>$username <span class='fas fa-caret-down'></span></li></a>";

							echo "<div class='user-dropdown'>";
							echo "<a href=\"user.php?id=$username\">my profile</a>";
							echo "<a href=\"edit-profile.php\">Edit profile</a>";
	            echo "<a href=\"logout.php\">Logout</a>";
							echo "</div>";
	          } else {
	            echo "<a href=\"login.php\"><li>sign up/login</li></a>";
	          }
			    ?>
					<script>
						$('#user-click').click(function() {
							$('.user-dropdown').toggle();
						});
					</script>
				</ul>
			</div>
		</div>
	</nav>
	<div class="nav-space"></div>
