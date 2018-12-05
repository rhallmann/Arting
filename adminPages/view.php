<?php
require 'connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM posts WHERE postID = :id";
$statement = $db->prepare($query);

$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();

$post;
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

<!DOCTYPE html>
<html>
<head>
	<title> View Posting</title>
</head>
<body>
	<h1>View Posting - <?= $_SESSION['username']?></h1>
	<form method='post' action="">
		<input type="submit" value="Logout" name="but_logout">
	</form>
	<ul id="menu">
		<li><a href="feed.php" >Feed</a></li>
		<li><a href="users.php" >Users</a></li>
		<li><a href="register.php" >Create New User</a></li>
	</ul>


	<?php while ($row = $statement->fetch()): ?>

		<?php

		$post = $row;

		$currentUser = $row['userID'];

		$query2 = "SELECT username FROM users WHERE userID = :currentUser";
		$statement2 = $db->prepare($query2);
		$statement2->bindValue(':currentUser', $currentUser);
		$statement2->execute();

		$userRow = $statement2->fetch();

		?>
		<ul style="text-align:center;">
			<h2><?= $row['pieceName'] ?> BY : <?= $userRow['username'] ?></h2>

			<?php echo '<img src="data:image/png;base64,'.base64_encode( $row['pieceImage']  ).'"width=900 border="8"/>'; ?>
			<p>Description : <?= $row['description'] ?></p>
			<p>Genre: <?= $row['genre'] ?></p>
			<p>Date Created : <?= $row['dateSubmitted'] ?></p>
		</ul>
		<li><a href="edit.php?id=<?= $row['postID'] ?>">edit</a></li>

	<?php endwhile ?>

	<h2>Comments</h2>
	<?php

//-----Comment area------

	$query = "SELECT * FROM comments WHERE postID = :id ORDER BY dateSubmitted";
	$statement = $db->prepare($query);

	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();

	?>

	<?php while ($row = $statement->fetch()): ?>

		<?php

		$query2 = "SELECT username FROM users WHERE userID = :poster";
		$statement2 = $db->prepare($query2);
		$statement2->bindValue(':poster', $row['userID']);
		$statement2->execute();

		$userRow = $statement2->fetch();

		?>
		<ul style="background-color:lightgrey; overflow:auto;">
			<p><?= $userRow['username'] ?> Posted : <?= $row['dateSubmitted'] ?></p>
			<p><?= $row['comment']?></p>
		</ul>

	<?php endwhile ?>

	<?php
	$query = "SELECT * FROM users WHERE username = :currentUser";

	$statement = $db->prepare($query);
	$statement->bindValue(':currentUser', $_SESSION['username']);

	$statement->execute();

	$poster = $statement->fetch();
	?>


	<form method="post" action="createComment.php ">
		<label for="comment">Post a Comment:</label>
		<textarea name="comment" id="comment"></textarea>
		<input type="hidden" name="postID" value=<?= $post['postID'] ?> />
		<input type="hidden" name="userID" value=<?= $poster['userID'] ?> />
		<input type="submit" name="command" value="Comment" />
	</form>
</body>
</html>