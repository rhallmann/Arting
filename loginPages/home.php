<?php
require 'connect.php';

// Check user login or not
if(!isset($_SESSION['username'])){
    header('Location: loginHub.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: loginHub.php');
}
?>
<!doctype html>
<html>
<head></head>
<body>
    <h1>Homepage - <?= $_SESSION['username']?></h1>
    <ul id="menu">
        <li><a href="../userPages/feed.php" >Feed</a></li>
        <li><a href="../userPages/create.php" >Create New Piece</a></li>
    </ul>
    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>
</body>
</html>