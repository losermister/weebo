<!DOCTYPE html>
<html lang="en">

<head>
	<link href="css/main.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.search-show input[type="text"]').on("keyup input",function(){

			 // alert("no");
				var inputVal = $(this).val();
				 var resultDropdown = $(this).siblings(".result");
				if(inputVal.length){
					$.get("update-search.php", {term: inputVal}).done(function(data){
						resultDropdown.html(data);
					});
					// alert('hello');
				}

				else{
					resultDropdown.empty();
				}
			});


			// Set search input value on click of result item
	 $(document).on("click", ".result p", function(){
			 $(this).parents(".search-show").find('input[type="text"]').val($(this).text());
			 $(this).parent(".result").empty();
	 });

		});

	</script>

</head>

<body>
	<nav>
		<div class="container">
			<div class="row">
				<ul class="fl-left">
					<li id="logo"><a href="index.php">weebflix</a></li>
				</ul>
				<div class="fl-left search-show">
					<input type="text"  placeholder="search for anime...">
					<div class="result"></div>
				</div>
				<ul class="fl-right">


					<li><a href="all-shows.php">browse</a></li>

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
