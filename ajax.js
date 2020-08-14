function addLike(id){  
	 	jQuery.ajax({ 
	 		type: "POST", 
	 		url: 'addLikes.php', 
	 		data: { id : id },
			dataType: "html",
	 		success: function(response) 
	 		{ 
	 			 			
	 			document.getElementById('likes'+id).innerHTML = ' &nbsp Likes '+response;
	 			
	 			
	 		} 
	 	}); 
	}

function subLike(id){
	jQuery.ajax({ 
 		type: "POST", 
 		url: 'subLikes.php', 
 		data: { id : id },
		dataType: "html",
 		success: function(response) 
 		{ 
 			document.getElementById('likes'+id).innerHTML = ' &nbsp Likes '+response;
 			
 		} 
 	}); 	
}
function comments(id){

	jQuery.ajax({
		type: "POST",
		url: 'showComments.php',
		data: { id : id },
		dataType: "html",
		success: function(response){
			document.querySelector('.popup').style.display = "flex";
			document.getElementById('comments').innerHTML = response;			
		}
		
	});
}
function commentsVisit(id){

	jQuery.ajax({
		type: "POST",
		url: 'showCommentsVisit.php',
		data: { id : id },
		dataType: "html",
		success: function(response){
			document.querySelector('.popup').style.display = "flex";
			document.getElementById('comments').innerHTML = response;			
		}
		
	});
}
function hideComments(){
		document.querySelector('.popup').style.display = "none";

}

function showContact(){
	//document.getElementById('contact').style.display = "block";
	$("#contact").show("slow");
}



