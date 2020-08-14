<?php

	session_start();
	
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
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<title>Search results</title>

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
					<form action="search.php" method="POST" class="form-inline active">
					<input type="text" class="form-control mr-1 mt-3 logWin" placeholder="Find user" name="search"/>
					</form>
				</div>
			</nav>
			
		</header>
		
		<main id="searchResult">
			<div class="container">
			<br/>
			<?php
				require_once "connect.php";
				$connection = new mysqli($host, $db_user, $db_password, $db_name);

				//Check if POST value exists 
				if($connection->connect_errno!=0){
						 	
						echo "Error: ".$connection->connect_errno;
				}
				else{
					if (isset($_POST['search'])){ 

						//Get the value from post method 
						$name = $_POST['search'] ; 
						if($result = @$connection->query('SELECT * FROM users WHERE name like "%'.$name.'%"')){
							$names=$result->num_rows;
							if($names>0){
								while($col = $result->fetch_assoc()){
									if($res = @$connection->query(sprintf("SELECT * FROM images WHERE owner = 
									'%s'",mysqli_real_escape_string($connection, $col['name'])))){
										$images = $res->num_rows;
									}
									echo '<div class="row">
										<div class="col-12">
										<div class="visit">
										<div class="userData">'. $col['name'].'<span style="font-size:18px"> &nbsp | &nbsp'.$images;
										if($images>1 || $images==0) echo ' Artworks';
										else echo ' Artwork';
										echo '</span></div><div class="profileLink">
										<form action="visitProfile.php" method="POST"> 
											 <input class = "visitBtn" type="submit" name="profile" value="Visit '.$col['name'].'"/> 
										</form>
										</div>
										</div>
										</div>
										<div style="clear:both;"></div>
										</div>';
									
									echo '<br/>';
								
								}
								
							}else{
								echo 'Sorry! No users found.';
							}	
						}
						$connection->close();
					}
				} 
			?>
		
		
			</div>
		</main>
		<footer id= "footer"> Thanks for visiting!</footer>

	<?php
		if(isset($_SESSION['error'])){
	
			echo $_SESSION['error'];
		}
	?>
	<script src="lightbox2-2.11.3/src/js/lightbox.js"></script>
	 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
