<?php

	session_start();
	
	if(!isset($_SESSION['logged'])){
		header('Location: index.php');
		exit();
		}
	
	if(isset($_POST['title'])){
	
		$ok=true;
		$title = $_POST['title'];
		//wrong length of nick
		if(strlen($title)<=0){
			$ok = false;
			$_SESSION['e_title']="Title cannot be empty";
		}
				
		$description = $_POST['description'];
		//description doesnt have any rules
		
		$category = $_POST['category'];
		//category doesnt have rules
		
	
		    	
		
		
		
		
		require_once "connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0){
		 	
			throw new Exception(mysqli_connect_errno());
			}else{
				//najwieksze obecne id
				$result = $connection->query("SELECT id FROM images order by id desc;");
		
				if(!$result) throw new Exception($connection->error);
						
				if($ok==true){
					$col = $result->fetch_assoc();
					$mimetype = $_FILES['img']['type'];
					if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png') {
						if($connection->query("INSERT INTO images VALUES($col[id]+1, '$_SESSION[user]' , '$category' , '0' , '0' , '$title' , '$description' )")){
							
								$name = $_FILES["img"]["name"];
								$newfilename= ($col['id']+1).'.png';
								if(isset($name) and !empty($name)){     
								    if(move_uploaded_file($_FILES["img"]["tmp_name"], "gallery/" . $newfilename)){
									$_SESSION['correctAdd']=true;
									header('Location: profile.php');
								    }
								} else {
								    $ok = false;
								    $_SESSION['e_img']="Select image file";
								}
								
								
						}else{
							throw new Exception($connection->error);
						}
					}else{
						$ok = false;
						$_SESSION['e_img']="Wrong format of the file";
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
	<link rel="stylesheet"href="style.css" type="text/css"/>
	<link rel="stylesheet"href="css/fontello.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300;400;700&display=swap" rel="stylesheet"> 
	<title>Add your art!</title>
	<style>
	
		.error{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	<div id="add">
		<div id="title"><a class="addMenu" href="index.php">Add your piece to Nova Art</a></div>
		<form method="POST" ENCTYPE="multipart/form-data">
			<input type="text" class="logWin" name="title" placeholder="Title"><br/>
			 <?php 
			 	if(isset($_SESSION['e_title'])) {
			 		echo '<div class="error">'.$_SESSION['e_title'].'</div>';
			 		unset($_SESSION['e_title']);
			 }
			 ?>
			<input type="text" class="logWin" name="description" placeholder="Your description">
				   <br/><br/>
				   
		       <input type="file" class="logWin" name="img" accept="image/*"> 
		       <?php 
		    		if(isset($_SESSION['e_img'])) {
		  			echo '<div class="error">'.$_SESSION['e_img'].'</div>';
		 			unset($_SESSION['e_img']);
				}
		        ?>
		  
		  <br/><br/>
				
				  <span style="font-size: 25px;">Select category</span> <br/>
					  <div><label><input type="radio" value = "photography" name="category" checked >Photography</label></div>
					  <div><label><input type="radio" value="digital" name="category">Digital</label></div>
					  <div> <label> <input type="radio" value="drawing" name="category">Drawing</label></div>
					  <div><label><input type="radio" value="painting" name="category">Painting</label></div>
					
		
				<?php
					if(isset($_SESSION['error'])){
						echo $_SESSION['error'];
					}
				?>
				<input type="submit" class="button" value="Add"/>
			
		</form>
	</div>
	
</body>
</html>
