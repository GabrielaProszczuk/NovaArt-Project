<?php
	session_start();
	unset($_SESSION['error']);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet"href="style.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<title>Welcome to Nova Art!</title>
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
		<div id="content">
			<div id="welcome">
			<?php
				if(isset($_SESSION['logged']) && ($_SESSION['logged']==true)){
					echo "Welcome to Nova Art ".$_SESSION['user']."!";
				}
				else echo 'Welcome to Nova Art! Join the community, follow 					incredible artist and share your own pieces! <div id="links"><a 		
				href="logWindow.php" class="log">Login</a> <a href="register.php" 					class="log">Join</a></div>';
			?>
			</div>
			<div id="buttons">
			
				<a class="btn" href="#">Lear more about<br/> Nova Art!</a>
				<a class="btn" href="#">Add your own art!</a>
				<a class="btn" href="#">Explore the<br/>most popular!</a>
	 			<div style="clear:both"></div>
			</div>
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
