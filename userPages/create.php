<?php
require '../loginPages/connect.php';

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
<script src="canvasWork.js"></script>
<body>
    <h1>Homepage - Create - <?= $_SESSION['username']?></h1>
    <ul id="menu">
        <li><a href="feed.php" >Feed</a></li>
        <li><a href="drawing.php" >Draw a Piece</a></li>
    </ul>

    <form method="post" action="postingProcessing.php" enctype="multipart/form-data">
        <div>
            <label for="pieceName">Piece Name</label>
            <input name="pieceName" id="pieceName" />
        </div>
        <div>
            <label>File: </label>
            <input type="file" name="image" id="image" />
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div>
            <label for="genre">Genre</label>
            <textarea name="genre" id="genre"></textarea>
        </div>

        <div>
            <input type="submit" name="command" value="Create" id="btn" size="30">
        </div>
    </form>

    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>
</body>
</html>