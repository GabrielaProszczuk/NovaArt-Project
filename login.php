<?php

	session_start();
	if((!isset($_POST['login'])) || !($_POST['password'])){
		header('Location: logWindow.php');
		exit();
		}
	require_once "connect.php";
	
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($connection->connect_errno!=0){
		 	
		echo "Error: ".$connection->connect_errno;
	}
	else{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES,"UTF-8");
		 
		echo '<a href="logWindow.php">Back</a>';
		
		
		
		if($result = @$connection->query(sprintf("SELECT * FROM users WHERE name = 
		'%s'", 
		mysqli_real_escape_string($connection, $login)))){
			$users = $result->num_rows;
			if($users>0){
				$col = $result->fetch_assoc();
				
				if(password_verify($password, $col['password'])==true){
					$_SESSION['logged']=true;
					$_SESSION['id']=$col['id'];
					$_SESSION['user'] = $col['name'];
					
					unset($_SESSION['error']);
					$result->close();
					header('Location: index.php');
				}else{
					$_SESSION['error']='<span style="color:red">Wrong login 
					or password</span>';
					header('Location: logWindow.php');
				}
			}else{
				$_SESSION['error']='<span style="color:red">Wrong login or 
				password</span>';
				header('Location: logWindow.php');
			}
			
		}
		$connection->close();
	}
	
	
	
	
?>

