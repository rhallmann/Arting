<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Arting</title>
</head>
<body onload="getId('Popular');">

	<h1>Welcome to Arting</h1>

	<form>
		<div>			
			<a href="loginPages/loginHub.php">login/register</a>
			<label for="search"></label>
			<input name="search" id="searchBar" placeholder="search..."/>
		</div>
		<input type="button" value="Search" name="searchSubmit" onclick="getId(searchBar.value);">
	</form>

	<select name="search" onchange="getId(this.value);">
		<option value="Popular">Most popular</option>
		<option value="Newest">Newely posted</option>
		<option value="Rating">Highest rated</option>
	</select>


	<ul id="orderedContent">

	</ul>

	<script src="//code.jquery.com/jquery-1.12.0.js"></script>
	<script>
		function getId(val){
			$.ajax({
				type: "POST",
				url: "feedSearching.php",
				data: "id="+val,
				success: function(data){
					$("#orderedContent").html(data);
				}

			});
		}
	</script>
</body>
</html>