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
					<li id="logo"><a href="index.php">weebflix</a></li>
				</ul>
				<ul class="fl-left"></ul>
				<ul class="fl-right">
					<li><a href="all-shows.php">all shows</a></li>
					<?php
	          if (isset($_SESSION['valid_user'])) {
	          	$username = username_from_email($db);
	          	$avatar = avatar_from_email($db);
	          	echo "

							<li class='fvr-lnk'><a href=\"favourites.php\" ><span>" . get_num_favourites($db) . "</span>favourites</a></li>
						";
	            echo "<li class='user-act'><a id='user-click'><span class='avatar'><span class='avatar-img' style='background-image:url($avatar)'></span></span>$username <span class='fas fa-caret-down'></span></a></li>";

							echo "<div class='user-dropdown'>";
							echo "<a href=\"user.php?id=$username\">my profile</a>";
							echo "<a href=\"edit-profile.php\">Edit profile</a>";
	            echo "<a href=\"logout.php\">Logout</a>";
							echo "</div>";
	          } else {
	            echo "<li><a href=\"login.php\">sign up/login</a></li>";
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
