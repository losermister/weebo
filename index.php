<?php include('helper/header.php')?>
<?php



/*
		$hostname = 'localhost';
		$location = 'root';
		$pass = '	';
*/
		$dbname = 'anime_database';
		$con = mysqli_connect($hostname,$location,$pass,$dbname);
		$recent_anime = "SELECT * ";
		$recent_anime .= "FROM anime_show ";
		$recent_anime .= "ORDER BY anime_id DESC ";
		$recent_anime .= "LIMIT 12 ";
		
		
		$recent_epi = "SELECT * ";
		$recent_epi .= "FROM anime_link ";
		$recent_epi .= "LEFT JOIN anime_show ";
		$recent_epi .= "ON anime_link.name = anime_show.anime ";
		$recent_epi .= "ORDER BY id DESC ";
		$recent_epi .= "LIMIT 12";
		
		$anime_name = '';
		$episode_num = '';
		
		/* $anime_episodes = */
		$result = mysqli_query($con,$recent_anime);
		$result2 = mysqli_query($con, $recent_epi);
		
		?>

	
	<div class="banner-container">
		
		<div class="container">
		
			<div class="banner-text">
				
				<div class="col-12of12">
				<span><span class="fas fa-star"></span>Most popular this week</span>
				
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
			
			
			</div>
			<div class="col-9of12">
				<div class="row">
				
				
				
					<div class="col-12of12">
						
							<h3 class="cat"><span class="fas fa-upload"></span>recommendation</h3> 
				
					</div>
		
				</div>
				
				<div class="row">
				
						
				<?php 
				while($row = mysqli_fetch_array($result2)){
				$id = $row['anime_id'];
				$anime_name = $row['anime'];
				$bg_img = $row['bg_img'];
				$type = $row['Type'];
				$preview = $row['preview'];
				$rating = $row['review'];
				$episode = $row['episode'];
				$link = $row['link'];
				
				/* <span class='show-type'>Episode 1</span> */
				
				
				/*
		
				$anime_name = str_limit($anime_name, 100);
		*/
				echo"
				<div class='col-2of12'>
					<div class='show-container'>
						<div class='redirect'></div>
						
						<div class='show-img-container'><div class='show-img' style='background-image:url($bg_img)'></div></div>
						<div class='show-info'>
							
							<div class='show-descript'>
								<span class='show-title'>$anime_name</span>
								<span class='show-episode'>Episode $episode</span>
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
				
				<row>
				<a href="#" class="btn-small btn-primary center"><span class="fas fa-plus"></span>view more</a>
				</row>		
				
				<div class="row">
					<div class="col-12of12">
						
							<h3 class="cat">new Series</h3> 
				
					</div>
					
				
					
					
				</div>
				
		
				
				
				<?php 
				while($row = mysqli_fetch_array($result)){
				$id = $row['anime_id'];
				$anime_name = $row["anime"];
				$bg_img = $row['bg_img'];
				$type = $row['Type'];
				$preview = $row['preview'];
				$rating = $row['review'];
				$descript = $row['description'];
				
				/* <span class='show-type'>Episode 1</span> */
				
				
				/*
		
				$anime_name = str_limit($anime_name, 100);
		*/
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