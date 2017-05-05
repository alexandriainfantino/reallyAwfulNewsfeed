<html>
<head>

      <meta content = "text/html; charset = ISO-8859-1" http-equiv = "content-type">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
                	$(window).scroll(function() {
                    	if ($('body').height() < ($(window).height() + $(window).scrollTop())) {
				document.querySelector("#content").innerHTML += loadSelectedNews();
				document.querySelector("#content").innerHTML += "<br>"
				document.querySelector("#content").innerHTML += "<br>"
                    }
                });
            }); 
	</script>


</head>
<body>
<?php
	session_start();
	// Read the sessions
	if ($_SESSION["username"] != "") {
		echo "<br>Hello ";
    		echo $_SESSION["username"];
		echo " , your last visit was ";
	
		$user = $_SESSION["username"];
		$sessionStore = $user . "lastVisit";
		$lastVisit = $_SESSION[$sessionStore];
		if ($lastVisit == "never") {
			echo $lastVisit;
		}
		else{
			echo "$lastVisit[weekday], $lastVisit[month] $lastVisit[mday], $lastVisit[year]";
		}
		$date = getdate(date("U"));
		$_SESSION[$sessionStore] = $date;					

?>

	<h2>NEWS</h2>
	<input type="hidden" id="username" value="<?php echo $_SESSION['username'];?>">
	<div id="newsSelection">
		<input type="checkbox" name="newsType" value="http://www.espn.com/espn/rss/news" onclick="loadSelectedNews()" checked> All News
		<input type="checkbox" name="newsType" value="http://www.espn.com/espn/rss/nhl/news" onclick="loadSelectedNews()">Hockey
		<input type="checkbox" name="newsType" value="http://www.espn.com/espn/rss/nba/news" onclick="loadSelectedNews()">Basketball
		<input type="checkbox" name="newsType" value="http://www.espn.com/espn/rss/nfl/news" onclick="loadSelectedNews()">Football
	</div>

	<script>
		
		"use strict";
	  
		window.onload = init;
		
		function init(){
			var url = "http://espn.go.com/espn/rss/news";
			
			$.get(url).done(function(data){xmlLoaded(data);});
		}
		
		
		function xmlLoaded(obj){
			
			var items = obj.querySelectorAll("item");
		
			for (var i=0;i<items.length;i++){
				
				var newsItem = items[i];
				var title = newsItem.querySelector("title").firstChild.nodeValue;
				
				var link = newsItem.querySelector("link").firstChild.nodeValue;
				
				
					
				document.querySelector("#content").innerHTML += "<a href="+link+">"+title+"</a><input type='checkbox' name='"+title+"' onclick='addFavorite()' value="+link+">Favorite";
				document.querySelector("#content").innerHTML += "<br>"
				document.querySelector("#content").innerHTML += "<br>"
			
			}
		
		}	
	 	
		function loadSelectedNews(){
			$("#content").empty();         
     			var news = [];
     			$('#newsSelection :checked').each(function() {
       				news.push($(this).val());
     			});
			news.forEach(function(url) {
				var url = url;
				$.get(url).done(function(data){xmlLoaded(data);}); 
			});	
		}

		function loadFavorites(){
			
		}

		function addFavorite(){
			$("#favorites").empty();
			$("#favorites").append("Favorite Stories");
			var username = $("#username").val();
			var favoriteStories = {};
			$('#content :checked').each(function() {
				favoriteStories[$(this).val()] = $(this).attr('name');
				console.log(favoriteStories);
			});
			var num=0;
			$.each(favoriteStories, function(key, value) {
				$('#favorites').append("<br>");
				$('#favorites').append("<a href="+key+">"+value+"</a>");
				$('#favorites').append("<br>");
				$('#favorites').append("<br>");
				
				document.cookie = username+"link"+num+"="+key+"";
				document.cookie = username+"title"+num+"="+value+"";
				num = num+1;

			});
	

		} 
	  
	  
	</script>
	
	

	<div id="content" style="float:left;">
		
	</div>
	<div id="favorites" style="float:right; width="45%";">
		Favorite Stories
		<br>
		<?php
			$count = array_count_values($_COOKIE);
			$count = count($count);
			for ($x = 0; $x<= $count; $x++){
				$userLink = $_SESSION['username'] . "link" . (string)$x;
				$userTitle = $_SESSION['username'] . "title" . (string)$x;
				$link = $_COOKIE[$userLink];
				$title = $_COOKIE[$userTitle];
				?>
				<br>
				<a href="<?php echo $link; ?>"><?php echo $title; ?></a>
				<br>
				<?php
			}
		?> 
	</div>
<?php
	}
	else {
		echo "You are not logged in";
	}
?>
</body>
</html>
