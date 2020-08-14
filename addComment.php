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
	<title>My profile</title>
	
</head>

<body>

<?php

	session_start();


	$user=$_SESSION['user'];
	require_once "connect.php";
	$connection = new mysqli($host, $db_user, $db_password, $db_name);

		if($connection->connect_errno!=0){
			 	
			echo "Error: ".$connection->connect_errno;
		}
		else{
			if (isset($_POST['id'])){ 
				if(isset($_POST['comment'])){
					$comment = $_POST['comment'];
					$id = $_POST['id'];
					$date=date("Y-m-d");
					if($connection->query("INSERT INTO comments VALUES(NULL,'$id', '$user', '$comment','$date')")){
						echo '<p class="logWin"> Comment added</p>';
						if($result2 = @$connection->query("UPDATE images SET  comments = comments + 1 WHERE  id =".$id)){}
					}else echo "uj";
				}else{
					echo "ehhhh";
				}
				
			}
			$connection->close();
		} 
	?>
</body>
</html>
