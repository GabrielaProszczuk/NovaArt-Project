<?php
	session_start();
	unset($_SESSION['error']);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<link rel="stylesheet"href="../bootstrap/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet"href="style.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<title>About Nova Art!</title>

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
						<li class="nav-item"><a class="nav-link" href="index.php">Main Page</a></li>
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
	
	<main class="about">
		<div class="container">
		<div class="row">
		<div class="col-12">
		<header><p class="aboutTitle">The perfect place to share your art!</p></header>
		<section class="description">Founded in August 2020, NovaArt is a great online social network for artists and art enthusiasts, 
		and a platform for emerging and established artists to exhibit, promote, and share their works with an enthusiastic, art-centric community. <br/><br/>
		Safe space for everyone connected to art. No matter your skills, your art is always welcome! Connect with other artists, learn and teach. Keep it small as your artistic diary or be as loud as you like in promotion of your artworks. All is up to you. <br/> <br/> 
		Network is still growing, gaining new users and our team is working continually to make it higher quality. If you have anythhing on mind that would enrich NovaArt, let us know.
		<br/> <br/>
		And for now, have fun using Nova Art and create!
		</section>
		</div>
		</div>
		</div>
	</main>
	<footer id= "footer"> Thanks for visiting!</footer>

	<?php
		if(isset($_SESSION['error'])){
	
			echo $_SESSION['error'];
		}
	?>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 	 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
