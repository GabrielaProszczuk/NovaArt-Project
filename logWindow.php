<?php

	session_start();
	
	if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true)){
		header('Location: index.php');
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
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<title>Hi</title>
</head>

<body>
	<div id="login">
		<div id="title"><a class="logMenu" href="index.php">Welcome to Nova Art</a></div>
		<form action="login.php"  method="post">
			<i class="icon-user-circle"></i><input type="text"  class="logWin" name="login" placeholder="Login"/>
			<br/><br/>
			<i class="icon-lock"></i><input  class="logWin" type="password" name="password" placeholder="Password"/>
			<br/><br/>
			<?php
				if(isset($_SESSION['error'])){
			
					echo $_SESSION['error'];
				}
			?>
			<br/>
			<input type="submit" class="button" value="Login"/>
		
		</form>
		<br/><br/>
		<div id="registerLink">
		If you don't have an account, register here
		<br/><br/>
		<a class="reg" href="register.php">Register</a>
		</div>
		
	</div>
	
</body>
</html>
