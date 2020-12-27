<?php
	session_start();
	if(!isset($_POST['profile'])){
		header('Location: index.php');
		exit();
	}
	$user1 = $_POST['profile'];	//nazwa usera, które profil odwiedzamy
	$user = substr($user1,6);

	if(!isset($_SESSION['logged'])){
		header('Location: logWindow.php');
		exit();
	}
 
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<link rel="stylesheet"href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet"href="style.css" type="text/css"/>
	<link rel="stylesheet"href="css/fontello.css" type="text/css"/>
	<script src="jquery-3.5.1.min.js"></script>
	<link href="lightbox2-2.11.3/src/css/lightbox.css" rel="stylesheet" />
	<script src="ajax.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<title><?php echo $user; ?></title>
	
</head>

<body>
	<header class="top">
		
			<nav class="navbar navbar-dark navbar-expand-lg">
				<a class="navbar-brand" href="index.php">Nova Art</a>
				<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				 
				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item "><a class="nav-link" href="index.php">Main Page</a></li>
						<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown"  role="button" aria-expanded="false" id="submenu" aria-haspopup="true" href="#">Categories</a>
						
							<div class="dropdown-menu" aria-labbeledby="submenu">
								
								<form  class="dropdown-item" method="POST" action="category.php">
								<input class="category" type="submit" name="category" value="Photography"/>
								</form>
								
								<form class="dropdown-item" method="POST" action="category.php">
								<input class="category" type="submit" name="category" value="Digital"/>
								</form>
								
								<form class="dropdown-item" method="POST" action="category.php">
								<input class="category" type="submit" name="category" value="Drawings"/>
								</form>
								
								<form class="dropdown-item" method="POST" action="category.php">
								<input class="category" type="submit" name="category" value="Paintings"/>
								</form>
								
							</div>
						</li>
						<li class="nav-item"><a class="nav-link" href="profile.php">My profile</a></li>
						<?php
							if(isset($_SESSION['logged']) && ($_SESSION['logged']==true)){
								echo '<li class="nav-item" ><a href="loggout.php" class="nav-link " >Logout</a></li>';
							}
							else echo '<li class="nav-item" ><a class="nav-link " href="logWindow.php">Login</a></li>';
						?>			
			 				
					</ul>
					<form action="search.php" method="POST" class="form-inline">
					<input type="text" class="form-control mr-1 mt-3 logWin" placeholder="Find user" name="search"/>
					</form>
				</div>
			</nav>
			
		</header>
	<main>
		<div class="container">
			<header id="profile">
				<div class="row">
					<div class="col-12">
		<?php
			require_once "connect.php";
			
			$connection = @new mysqli($host, $db_user, $db_password, $db_name);
			
			
			if(isset($_SESSION['logged'])){
				$me = $_SESSION['user'];
			}
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
						echo '<p id="user">'.$user.'</p>';
						
						
						echo 'On Nova Art since &nbsp '.$col["date"];
						if($images>1) echo ' &nbsp &nbsp | &nbsp &nbsp '.$images.' Artworks';
						else echo ' &nbsp &nbsp | &nbsp &nbsp '.$images.' Artwork';
						if(isset($_SESSION['logged']) && ($_SESSION['logged']==true) && $user==$me){
							echo '<a class="addBtn" href="addArt.php">Add new artwork</a>';
						}
					}
					else echo "No information about this profile";
				}
			}
		?>
		
	
			</div>
			</div>
			</header>
			<section id="images"> 
	<?php
		
		//tu było nawiązywanie połączenia
		if($connection->connect_errno!=0){
			 	
			echo "Error: ".$connection->connect_errno;
		}
		else{
			
			
			if($result = @$connection->query('SELECT * FROM images where owner = "'.$user.'"')){
			
				$images = $result->num_rows;
				
				if($images>0){
				//kolumny z obrazami zalogowanego użytkownika
					
					while ($row = $result->fetch_assoc()) {
	       			
					$path = "./gallery";

					if ($handle = opendir($path)) {
					    while (false !== ($file = readdir($handle))) {
						if ('.' === $file) continue;
						if ('..' === $file) continue;
						if($file==$row['id'].".jpg" || $file==$row['id'].".png" || $file==$row['id'].".jpeg" || $file==$row['id'].".gif"){
						
							if($result2 = @$connection->query('SELECT * FROM likes where person = "'.$me.'" AND idImage = "'.$row['id'].'"'))	{
								
								$likes = $result2->num_rows;
								
								if($likes>0 ){echo '
								<div class="row">
								<div class="col-12">	
									<div class="photo">
										<div class="overlay">
											<a href="gallery/'.$file.'" data-lightbox="artworks" data-title="'.$row['title'].'" ><img class="image" src="gallery/'.$file.'"></a>
											<a class="desc">
											<span style="font-size:23px;">'.$row['title'].'</span>
											<br/><span onClick="commentsVisit('.$row['id'].')" id="comment" class="comment">Comments '.$row['comments'].'</span><span id="likes'.$row['id'].'">
											<span style="font-size:16px;"> 
											&nbsp Likes '.$row['likes'].'&nbsp';										
											if(isset($_SESSION['logged'])){
												echo '
												<span style="color:#EC9900;"><i onClick="subLike('.$row['id'].')" id ="heart" class="icon-heart"></i></span>';
												}
												echo'
											</span>
											</span><br/><br/>'.	
											$row['description'].' </a>
										</div>
										</div>
										</div>
			
									</div>';
								    }
								    else{ echo '
								    <div class="row">
									<div class="col-12">	
									<div class="photo">
										<div class="overlay">
											<a href="gallery/'.$file.'" data-lightbox="artworks" data-title="'.$row['title'].'" ><img class="image" src="gallery/'.$file.'"></a>
											<a class="desc">
											<span style="font-size:23px;">'.$row['title'].'</span>
											<br/><span onClick="commentsVisit('.$row['id'].')" id="comment" class="comment">Comments '.$row['comments'].'</span><span id="likes'.$row['id'].'">
											<span style="font-size:16px;"> 
											&nbsp Likes '.$row['likes'].'&nbsp';
											if(isset($_SESSION['logged'])){
												echo '
												<span style="color:#EC9900;"><i onClick="subLike('.$row['id'].')" id ="heart" class="icon-heart"></i></span>';
												}
												echo'
											</span>
											</span><br/><br/>'.	
											$row['description'].' </a>
										</div>
										</div>
										</div>
									</div>';
								    }	
								    echo '<div class="popup">
										<div id="comments">
											here are comments
													
										</div>
											</div>';
							} 
							
						}
						
					    }
					    closedir($handle);
					}
					}	
					
					
				}else{
					echo '<span style="color:white;">&nbsp No artwork added yet.</span>';
				}
				
	    		}

				
			$connection->close();
		}
		


	?>
	</section>
	</main>
	<footer id= "footer"> Thanks for visiting!</footer>
	
	<?php
		if(isset($_SESSION['error'])){
	
			echo $_SESSION['error'];
		}
	?>
	<script src="lightbox2-2.11.3/src/js/lightbox.js"></script>
	 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>								
