<?php include('helper/header.php')?>
<?php



/*
		$hostname = 'localhost';
		$location = 'root';
		$pass = '	';
*/
/* 		$dbname = 'anime'; */
/* 		$con = mysqli_connect($hostname,$location,$pass,$dbname); */
		$recent_anime = "SELECT * ";
		$recent_anime .= "FROM shows ";
		$recent_anime .= "ORDER BY show_id DESC ";
		$recent_anime .= "LIMIT 18 ";
		
		
		$recent_epi = "SELECT * ";
		$recent_epi .= "FROM links ";
		$recent_epi .= "LEFT JOIN shows ";
		$recent_epi .= "ON links.show_id = shows.show_id ";
		$recent_epi .= "ORDER BY show_id DESC ";
		$recent_epi .= "LIMIT 24";
		
		$anime_name = '';
		$episode_num = '';
		
		/* $anime_episodes = */
		$result = mysqli_query($db,$recent_anime);
		$result2 = mysqli_query($db, $recent_epi);
		
		?>

	
	<div class="banner-container">
		
		<div class="container">
		
			<div class="banner-text">
				
				<div class="col-12of12">
				<span>staff pick</span>
				
				</div>
				
				
			</div>
		
		
			<div class="banner-details">
				
				<div class="col-6of12">
				<h2>kill la kill</h2>
				<p>During her family's move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches, and spirits, and where humans are changed into beasts.</p>
				
				<a href="#" class="btn btn-primary"><!-- <span class="fas fa-play"></span> -->watch series</a>
				<a href="#" class="btn btn-secondary"><!-- <span class="fas fa-play"></span> --><span class='fas fa-bookmark'></span>bookmark</a>
				
				</div>
				
				
			</div>
		</div>
		<div class="banner-overlay">
		
		</div>
		
		<div class="banner-img-container">
			<div class="show-img" style="background-image:url('http://i0.kym-cdn.com/photos/images/original/000/686/177/af4.jpg')"></div>
		</div>
	
	</div>






	<div class="container content">
		<div class="row content" >
			<div class="col-3of12">
			
				<div class="row">
					<div class="col-12of12">
							<h3 class="cat">recent uploads</h3> 
					</div>
		
				</div>
				<div class="row">
								<?php 
				while($row = mysqli_fetch_array($result2)){
				$id = $row['show_id'];
				$anime_name = $row["name"];
				$bg_img = $row['bg_img'];
				$descript = $row['description'];

				echo"
				<div class='col-2of12'>
					<div class='show-container'>
						<div class='redirect'></div>
						
						<div class='show-img-container'><div class='show-img' style='background-image:url($bg_img)'></div></div>
						<div class='show-info'>
							
							<div class='show-descript'>
								<span class='show-title'>$anime_name</span>
								
							</div>
							
							<div class='functions'>
								<span class='save fas fa-bookmark'></span>
							<!-- 	<span><span class='fas fa-comment'></span> 100</span> -->
							</div>
						
						</div>
					</div>
				</div>
				";}
				
				?>		
	
		
		
		
					
				</div>
			</div>
			
			
			
			
			<div class="col-9of12">

				<div class="row">
					<div class="col-12of12">
						
							<h3 class="cat">show recommendation</h3> 
				
					</div>

				</div>
				
		
				<div class="row">
				
				<?php 
				while($row = mysqli_fetch_array($result)){
				$id = $row['show_id'];
				$anime_name = $row["name"];
				$bg_img = $row['bg_img'];
				$descript = $row['description'];

				echo"
				<div class='col-2of12'>
					<div class='show-container'>
						<div class='redirect'></div>
						
						<div class='show-img-container'><div class='show-img' style='background-image:url($bg_img)'></div></div>
						<div class='show-info'>
							
							<div class='show-descript'>
								<span class='show-title'>$anime_name</span>
								
							</div>
							
							<div class='functions'>
								<span class='save fas fa-bookmark'></span>
							<!-- 	<span><span class='fas fa-comment'></span> 100</span> -->
							</div>
						
						</div>
					</div>
				</div>
				";}
				
				?>		
	
	
			
				</div>
		</div>
	</div>
	
	
	<footer>
	
		<div class="container">
			<div class="row">
				weqwe
			</div>
			
		</div>


	</footer>
	
	
</body>

</html>