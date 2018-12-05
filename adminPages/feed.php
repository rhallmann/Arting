<?php
require 'connect.php';

// Check user login or not
if(!isset($_SESSION['username'])){
    header('Location: loginHub.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: ../loginPages/loginHub.php');
}

?>
<!doctype html>
<html>
<head></head>
<body onload="getId('Popular');">
    <h1>Administrative Pannel - feed - <?= $_SESSION['username']?></h1>

    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>

    <ul id="menu">
        <li><a href="users.php" >Users</a></li>
        <li><a href="register.php" >Create New User</a></li>
    </ul>
    
    <form>
        <div>
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