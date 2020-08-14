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
	<link rel="stylesheet"href="css/fontello.css" type="text/css"/>
	<script src="jquery-3.5.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<script src="ajax.js"></script>
	<title>Welcome to Nova Art!</title>
	<style>
	#contact{
		display: none;
		text-align: center;
		font-weight: 400;
		font-size: 22px;
		background: rgb(0,0,0,0.6);
		min-height: 100px;
		margin-top: 30px;
		padding-top: 30px;
		padding-bottom: 30px;
		border-radius: 5px;
		margin-bottom: 30px;
	}
	.log:hover{
		color:#EC9900;
		text-decoration: none;
	}

	</style>


<body>
	
		<header class="top">
		
			<nav class="navbar navbar-dark navbar-expand-lg">
				<a class="navbar-brand" href="index.php">Nova Art</a>
				<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				 
				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active"><a class="nav-link" href="index.php">Main Page</a></li>
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
	
		<main id="content">
			<div class="container">
				<section class="welcome">
					<div class="row">
							<div class="col-12">
							<?php
								if(isset($_SESSION['logged']) && ($_SESSION['logged']==true)){
									echo "Welcome to Nova Art ".$_SESSION['user']."!";
								}
								else echo 'Welcome to Nova Art! Join the community, follow incredible artist and share your own pieces! <div id="links"><a 		
								href="logWindow.php" class="log">Login</a> <a href="register.php" class="log">Join</a></div>';
							?>
							</div>
					</div>
				</section>
				<div class="row">
					
						<div class="col-md-6 col-lg-4">
						<a class="btn" href="aboutNA.php">Lear more about<br/> Nova Art!</a>
						</div>
						<div class="col-md-6 col-lg-4">
						<a class="btn" href="#" onClick="showContact()" >Contact us!</a>
						</div>
						<div class="col-md-6 col-lg-4 offset-md-3 offset-lg-0">
						<a class="btn" href="popular.php">Explore the<br/>most popular!</a>
						</div>
			 			
					
				</div>
				<div  id="contact">
				<div class="row" >
					<div class="col-lg-4">
						<i class="icon-phone"></i> Phone number: </br> 609 995 618
					</div>
					<div class="col-lg-4">
						<i class="icon-mail-alt"></i> E-mail: <br/> gabrielaproszczuk@gmail.com
					</div>
					<div class="col-lg-4">
						<i class="icon-laptop"></i> Page: <br/> proszczukgabriela.pl	
					</div>
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
	
 	 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    	<script src="../bootstrap/js/bootstrap.min.js"></script>
	
</body>
</html>
