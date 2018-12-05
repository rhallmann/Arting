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
<script src="http://hongru.github.io/proj/canvas2image/canvas2image.js"></script>
<script>
    function to_image(){
        var canvas = document.getElementById("can");
        document.getElementById("theimage").src = canvas.toDataURL();
        Canvas2Image.saveAsPNG(canvas);
    }
</script>
<body onload="init()">
    <h1>Homepage - Create</h1>
    <ul id="menu">
        <li><a href="feed.php" >Feed</a></li>
        <li><a href="create.php" >Create New Piece</a></li>
    </ul>

    <canvas id="can" width="400" height="400" style="top:10%;left:10%;border:2px solid;"></canvas>
    <div style="top:12%;left:43%;">Choose Color</div>
    <div style="top:15%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="color(this)"></div>
    <div style="top:15%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="color(this)"></div>
    <div style="top:15%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="color(this)"></div>
    <div style="top:17%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="color(this)"></div>
    <div style="top:17%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="color(this)"></div>
    <div style="top:17%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="color(this)"></div>
    <div style="top:20%;left:43%;">Eraser</div>
    <div style="top:22%;left:45%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>  
    <div>
        <input type="button" value="save" id="btn" size="30" onclick="to_image()">
    </div>

    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>
</body>
</html>