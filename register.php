<?php

	session_start();
	
	if(isset($_POST['mail'])){
	
		$ok=true;
		$nick = $_POST['nick'];
		//wrong length of nick
		if((strlen($nick)<3) || (strlen($nick)>20)){
			$ok = false;
			$_SESSION['e_nick']="Nick must be min 3 i max 20 letters";
		}
		
		//czy tylko alfanumeryczne w nicku
		if(ctype_alnum($nick)==false){
			$ok = false;
			$_SESSION['e_nick']="Nick must contain olny alphanumeric signs";
		}
		
		$mail = $_POST['mail'];
		//is email correct
		$mailCorrect = filter_var($mail, FILTER_SANITIZE_EMAIL);
		if(($mail!=$mailCorrect) || (filter_var($mailCorrect, 
		FILTER_VALIDATE_EMAIL)==false)){
			$ok = false;
			$_SESSION['e_mail']="Mail is incorrect";
		}
		
		//passwords
		$pass1 = $_POST['password1'];
		$pass2 = $_POST['password2'];
		//wrong length of passwords
		if((strlen($pass1)<8) || (strlen($pass1)>20)){
			$ok = false;
			$_SESSION['e_password']="Password must be min 8 i max 20 letters";
		}
		if($pass1!=$pass2){
			$ok = false;
			$_SESSION['e_password']="Passwords are not the same";
		}
		
		$pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
		//checked regulations 
		if(!isset($_POST['regulations'])){
			 $ok = false;
			$_SESSION['e_regulations']="Accept the regulations!";
		}
		
		$key = "6LcS3xYaAAAAALR9JcWfa0aTY3Kh4RJvSpYqnalm";
		
		$check = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$_POST['g-recaptcha-response']);
		
		$answer = json_decode($check);
		
		if($answer->success==false){
			$ok = false;
			$_SESSION['e_bot']="Check captcha!";
		}
		
		require_once "connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0){
		 	
			throw new Exception(mysqli_connect_errno());
			}else{
				//czy email juz jest w bazie
				$result = $connection->query("SELECT id FROM users WHERE 
				mail='$mail'");
				if(!$result) throw new Exception($connection->error);
				$mails = $result->num_rows;
				if($mails>0){
					$ok = false;
					$_SESSION['e_mail']="Email already used!";
				}
				//czy nickname już jest w bazie
				$result = $connection->query("SELECT id FROM users WHERE 
				name='$nick'");
				if(!$result) throw new Exception($connection->error);
				$nicks = $result->num_rows;
				if($nicks>0){
					$ok = false;
					$_SESSION['e_nick']="Nick already used!";
				}
				
				if($ok==true){
					$date=date("Y-m-d");
					if($connection->query("INSERT INTO users
					VALUES(NULL,'$nick', '$pass_hash', '$mail','$date')")){
						$_SESSION['correctRegistration']=true;
						header('Location: welcome.php');
					}else{
						throw new Exception($connection->error);
					}
				}	
				
				
				$connection->close();
			}
		
		}catch(Exception $e){
			echo '<span style="color: red;">Error</span>';
			//info dla developera, a nie klienta
			echo '<br/>Error: '.$e;
		}
	}
	

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Register</title>
	<link rel="stylesheet"href="style.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet"href="css/fontello.css" type="text/css"/>
	 <script src="https://www.google.com/recaptcha/api.js"></script>
	<style>
	
		.error{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	<main id="login">
	<header><p id="title"><a class="logMenu" href="index.php">Welcome to Nova Art</a></p></header>
		<form method="post">
			 
			<i class="icon-user-circle"></i> 
			 <input class="logWin" placeholder="Nickname" type="text" name="nick"/><br/> 
			 <?php 
			 	if(isset($_SESSION['e_nick'])) {
			 		echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
			 		unset($_SESSION['e_nick']);
			 }
			 ?>
			 <br/>
			<i class="icon-mail-alt"></i>
			<input class="logWin" placeholder="E-mail" type="text" name="mail"/><br/> 
			<?php 
			 	if(isset($_SESSION['e_mail'])) {
			 		echo '<div class="error">'.$_SESSION['e_mail'].'</div>';
			 		unset($_SESSION['e_mail']);
			 }
			 ?>
			 <br/>
			<i class="icon-lock-open"></i> 
			<input class="logWin" type="password" placeholder="Password" name="password1"/><br/> 
			<?php 
			 	if(isset($_SESSION['e_password'])) {
			 		echo '<div class="error">'.$_SESSION['e_password'].'</div>';
			 		unset($_SESSION['e_password']);
			 }
			 ?>
			 <br/>
			<i class="icon-lock"></i> 
			<input class="logWin" type="password" placeholder="Repeat password" name="password2"/><br/>   <br/>
			
			<label>
			<input type="checkbox" name="regulations"/> Accept regulations <br/><br/>
			</label>
			<?php 
			 	if(isset($_SESSION['e_regulations'])) {
			 		echo '<div class="error">'.$_SESSION['e_regulations'].'</div>';
			 		unset($_SESSION['e_regulations']);
			 }
			 ?>
			<div class="g-recaptcha" data-sitekey="6LcS3xYaAAAAAFyTb9VS_nEue7YdeyfXoduercGY"></div>
			<br/>
			<?php 
			 	if(isset($_SESSION['e_bot'])) {
			 		echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
			 		unset($_SESSION['e_bot']);
			 }
			 ?>
			<input type="submit" class="button" value="register"/>	 
		</form>
	</main>
</body>
</html>
