<?php

require_once "connect.php";
$connection = new mysqli($host, $db_user, $db_password, $db_name);

	if($connection->connect_errno!=0){
		 	
		echo "Error: ".$connection->connect_errno;
	}
	else{
		if (isset($_POST['id'])){ 
			//Get the value from post method 
			$id = $_POST['id'] ;
			echo '<img src="closeButton.png" onClick="hideComments()" class="close" width=20 height=20/>';
			echo '<form action="addComment.php" method="post">
				<input class="comWin"  type="text" name="comment" placeholder="Your comment"/>
				<input type="submit" value="Add comment" class="comBtn"/>
				<input type="hidden" value ="'.$id.'" name="id"/>
				</form><div style="clear:both;"></div>' ;
			
			if($result3 = @$connection->query('SELECT * FROM comments where idImage = "'.$id.'"')){
				$comments = $result3->num_rows;
				if($comments>0){
					while ($data = $result3->fetch_assoc()) {
						echo '<div class="singleComment">';
						echo $data['comment'].'<br/><span class="commentInfo"> '.$data['user'].' '.$data['date'].'</span>';
						echo '</div>';
					}
				}else echo '<div class="singleComment">No comments yet.</div>';
			}
			
			
			$connection->close();
		}
	} 
?>


