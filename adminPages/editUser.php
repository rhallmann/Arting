<?php
require 'connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM users WHERE userID = :id";
$statement = $db->prepare($query);

$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$post = $statement->fetch();

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
<head>
    <title>Edit Posting</title>
</head>
<body onload="init()">

    <h1>Homepage - Update - <?= $_SESSION['username']?></h1>

    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>
    
    <ul id="menu">
        <li><a href="feed.php" >Feed</a></li>
        <li><a href="users.php" >Users</a></li>
        <li><a href="register.php" >Create New User</a></li>
    </ul>

    <form action="processing.php" method="post">
        <div>
            <label for="username">username</label>
            <input name="username" id="username" value='<?= $post['username'] ?>'/>
        </div>

        <div>
            <label for="email">email</label>
            <input name="email" id="email" value='<?= $post['email'] ?>'/>
        </div>

        <div>
            <label for="password">password</label>
            <input name="password" id="password" value='<?= $post['password'] ?>'/>
        </div>

        <div>
            <label for="confpassword">confirm password</label>
            <input name="confpassword" id="confpassword" value='<?= $post['password'] ?>'/>
        </div>

        <div>
            <label for="usertype">user type</label>
            <input id="usertype" name="usertype" value='<?= $post['userType'] ?>'>
        </div>

        <div>
          <input type="hidden" name="id" value=<?= $post['userID'] ?> />

          <input type="submit" name="command" value="update" />
          <input type="submit" name="command" value="delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
      </div>
  </form>
</body>
</html>