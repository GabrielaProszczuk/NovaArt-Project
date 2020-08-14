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
//show contact section
function showContact(){
	$("#contact").show("slow");
}

//hide main page and show about section
function hideContent(){
	document.querySelector('.mainPage').style.display = "none";
	myVar = setTimeout(showAbout, 100);
}
function showAbout(){
	$(".about").show("slow");
}

//hide about section and back to main page
function hideAbout(){
	document.querySelector('.about').style.display = "none";
	myVar = setTimeout(showContent, 100);
}
function showContent(){
	$(".mainPage").show("slow");
}

//hide main page and show popular section
function showPopular(){
	document.querySelector('.mainPage').style.display = "none";
	$(".mostPopular").show("slow");
}
//hide popular and show main

function hidePopular(){
	document.querySelector('.mostPopular').style.display = "none";
	myVar = setTimeout(showContent, 100);
}


