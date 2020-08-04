<?php 
//Connect to the database 
require_once "connect.php";
$connection = new mysqli($host, $db_user, $db_password, $db_name);

//Check if POST value exists 
if($connection->connect_errno!=0){
		 	
		echo "Error: ".$connection->connect_errno;
	}
	else{
		if (isset($_POST['id'])){ 

			//Get the value from post method 
			$id = $_POST['id'] ; 
			
			if($result = @$connection->query("UPDATE images SET  likes = likes + 1 WHERE  id =".$id)){
				if($res = @$connection->query("SELECT likes FROM images WHERE id = ".$id)){
					$likes = $res->fetch_assoc();
				}
				echo $likes['likes'];
				
			
			}
			$connection->close();
		}
	} 
?> 
