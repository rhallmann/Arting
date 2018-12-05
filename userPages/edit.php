<?php
require '../loginPages/connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM posts WHERE postID = :id";
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
<script src="canvasWork.js"></script>
<body onload="init()">
    <h1>Homepage - Update - <?= $_SESSION['username']?></h1>
    <ul id="menu">
        <li><a href="feed.php" >Feed</a></li>
        <li><a href="create.php" >Create New Piece</a></li>
    </ul>

    <form method="post" action="postingProcessing.php" enctype="multipart/form-data">
        <div>
            <label for="pieceName">Piece Name</label>
            <input name="pieceName" id="pieceName" value='<?= $post['pieceName'] ?>' />
        </div>
        <div>
            <label>File: </label>
            <input type="file" name="image"/>
            <p>Current Image</p>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $post['pieceImage']  ).'"/>'; ?>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $post['description'] ?></textarea>
        </div>

        <div>
            <label for="genre">Genre</label>
            <textarea name="genre" id="genre"><?= $post['genre'] ?></textarea>
        </div>

        <div>
          <input type="hidden" name="id" value=<?= $post['postID'] ?> />
          <input type="submit" name="command" value="Update" />
          <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
      </div>
  </form>

  <form method='post' action="">
    <input type="submit" value="Logout" name="but_logout">
</form>
</body>
</html>