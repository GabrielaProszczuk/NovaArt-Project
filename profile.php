

<?php

	session_start();
	if(!isset($_SESSION['logged'])){
		header('Location: logWindow.php');
		exit();
	}

	
	
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet"href="style.css" type="text/css"/>
	<link rel="stylesheet"href="css/fontello.css" type="text/css"/>
	<script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous">
	</script>
	<script> 
	 function addLike(id){  
	 	jQuery.ajax({ 
	 		type: "POST", 
	 		url: 'addLikes.php', 
	 		data: { id : id },
			dataType: "html",
	 		success: function(response) 
	 		{ 
	 			 			
	 			document.getElementById('likes'+id).innerHTML = ' &nbsp Likes '+response;
	 			
	 			
	 		} 
	 	}); 
	}
	 function subLike(id){
	 		jQuery.ajax({ 
		 		type: "POST", 
		 		url: 'subLikes.php', 
		 		data: { id : id },
				dataType: "html",
		 		success: function(response) 
		 		{ 
		 			document.getElementById('likes'+id).innerHTML = ' &nbsp Likes '+response;
		 			
		 		} 
		 	}); 	
	 }
	 
	
	 	  
	</script>
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<title>Hi</title>
	
</head>

<body>
	<div id="container">
		<div id="top">
			<div id="logo"> Nova Art </div> 
			<div id="menu">
				<ul>
					<li><a class="logMenu" href="index.php">Main Page</a></li>
					<li><a class="logMenu" href="#">Categories</a>
						<ol>
							<li><a class="logMenu" href="#">Photography</a></li>
							<li><a class="logMenu" href="#">Drawings</a></li>
							<li><a class="logMenu" href="#">Paintings</a></li>
							<li><a class="logMenu" href="#">Digital</a></li>
						</ol>
					</li>
					<li><a class="logMenu" href="profile.php">My profile</a></li>
					<li><a class="logMenu" href="#">Search</a></li>
					<?php
				if(isset($_SESSION['logged']) && ($_SESSION['logged']==true)){
					echo '<li><a href="loggout.php" class="logMenu" >Logout</a></li>';
				}
				else echo '<li><a class="logMenu" href="logWindow.php">Login</a></li>';
			?>
				</ul>
			</div>
			<div style="clear: both;"></div>
		</div>
		<div id="profile">
			<?php
				require_once "connect.php";
	
				$connection = @new mysqli($host, $db_user, $db_password, $db_name);
				$user = $_SESSION['user'];
				if($result = @$connection->query(sprintf("SELECT * FROM images WHERE owner = 
				'%s'",mysqli_real_escape_string($connection, $user)))){
					$images = $result->num_rows;
				}
				if($connection->connect_errno!=0){
					echo "Error: ".$connection->connect_errno;
				}
				else{	
					if($result = @$connection->query(sprintf("SELECT * FROM users WHERE name = 
					'%s'", mysqli_real_escape_string($connection, $user)))){
						$num = $result->num_rows;
						if($num>0){
							$col = $result->fetch_assoc();
							echo '<span style="font-size: 40px;">'.$user.'</span>';
							if(isset($_SESSION['logged']) && ($_SESSION['logged']==true)){
								echo '<a class="addBtn" href="addArt.php">Add new artwork</a>';
							}
							echo '<br/>';
							echo '<br/>';
							echo 'On Nova Art since &nbsp '.$col["date"];
							if($images>1) echo ' &nbsp &nbsp | &nbsp &nbsp '.$images.' Artworks';
							else echo ' &nbsp &nbsp | &nbsp &nbsp '.$images.' Artwork';
						}
						else echo "No information about this profile";
					}
				}
			?>
			
		
		</div>
		<div id="images"> 
		<?php
			
			//tu było nawiązywanie połączenia
			if($connection->connect_errno!=0){
				 	
				echo "Error: ".$connection->connect_errno;
			}
			else{
				
				$user = $_SESSION['user'];	
				
				if($result = @$connection->query('SELECT * FROM images where owner = "'.$user.'"')){
					echo "here";
					$images = $result->num_rows;
					
					if($images>0){
					//kolumny z obrazami zalogowanego użytkownika
						
						while ($row = $result->fetch_assoc()) {
		       			
						$path = "./gallery";

						if ($handle = opendir($path)) {
						    while (false !== ($file = readdir($handle))) {
							if ('.' === $file) continue;
							if ('..' === $file) continue;
							if($file==$row['id'].".jpg" || $file==$row['id'].".png" ){
							
								if($result2 = @$connection->query('SELECT * FROM likes where person = "'.$user.'" AND idImage = "'.$row['id'].'"')){
									
									$likes = $result2->num_rows;
									echo $likes;
									if($likes>0 ){echo '
										<div class="photo">
											<div class="overlay">
												<a href="#"><img class="image" src="gallery/'.$file.'"></a>
												<a class="desc">
												<span style="font-size:23px;">'.$row['title'].'</span>
												<br/>Comments '.$row['comments'].'<span id="likes'.$row['id'].'">
												<span style="font-size:16px;"> 
												&nbsp Likes '.$row['likes'].'&nbsp 
												<span style="color:#EC9900;"><i onClick="subLike('.$row['id'].')" id ="heart" class="icon-heart"></i></span>
												</span>
												</span><br/><br/>'.	
												$row['description'].' </a>
											</div>
				
										</div>';
									    }
									    elseif($likes==0){ echo '
										<div class="photo">
											<div class="overlay">
												<a href="#"><img class="image" src="gallery/'.$file.'"></a>
												<a class="desc">
												<span style="font-size:23px;">'.$row['title'].'</span>
												<br/>Comments '.$row['comments'].'<span id="likes'.$row['id'].'">
												<span style="font-size:16px;"> 
												&nbsp Likes '.$row['likes'].'&nbsp 
												<span style="color:white;"><i onClick="addLike('.$row['id'].')" id ="heart" class="icon-heart"></i></span>
												</span>
												</span><br/><br/>'.	
												$row['description'].' </a>
											</div>
				
										</div>';
									    }
									}    
							}
							
						    }
						    closedir($handle);
						}
						}	
						
						
					}else{
						echo "No artwork added yet";
					}
					
		    		}

					
				$connection->close();
			}
			
	
	
		?>
		</div>
		
		<div id= "footer"> Thanks for visiting!</div>
	</div>
	<?php
		if(isset($_SESSION['error'])){
	
			echo $_SESSION['error'];
		}
	?>
</body>
</html>
