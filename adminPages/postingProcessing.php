<?php

require 'connect.php';

$pieceName = filter_input(INPUT_POST, 'pieceName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$canvasimg = file_get_contents($_FILES['image']['tmp_name']);

if (!empty($_SESSION['username'])) {

	if ($_REQUEST['command'] == 'Create') {
		if ((!empty($pieceName)) && (!empty($description)) && (!empty($genre)) && (!empty($canvasimg)) ) {

			$query     = "INSERT INTO posts (userID, pieceName, pieceImage, description, genre) VALUES ((SELECT userID FROM users WHERE username = :userVal), :pieceName, :image, :description, :genre)";
			$statement = $db->prepare($query);

			$statement->bindValue(':pieceName', $pieceName);
			$statement->bindValue(':description', $description);
			$statement->bindValue(':genre', $genre);
			$statement->bindValue(':userVal', $_SESSION['username']);
			$statement->bindValue(':image', $canvasimg);
            // Execute the SQL.
			$statement->execute();
			header("Location: feed.php");
		}
	}


	else if ($_REQUEST['command'] == 'Update') {
		if ((!empty($pieceName)) && (!empty($description)) && (!empty($genre))) {


			$query     = "UPDATE posts SET pieceName = :pieceName, pieceImage = :image, description = :description, genre = :genre WHERE postID = :id";
			$statement = $db->prepare($query);

			$statement->bindValue(':pieceName', $pieceName);
			$statement->bindValue(':description', $description);
			$statement->bindValue(':genre', $genre);
			$statement->bindValue(':image', $canvasimg);
			$statement->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the SQL.
			$statement->execute();
			header("Location: feed.php");
		}
		else if ((!empty($pieceName)) && (!empty($description)) && (!empty($genre))  && (!empty($canvasimg))) {


			$query     = "UPDATE posts SET pieceName = :pieceName, pieceImage = :image, description = :description, genre = :genre WHERE postID = :id";
			$statement = $db->prepare($query);

			$statement->bindValue(':pieceName', $pieceName);
			$statement->bindValue(':description', $description);
			$statement->bindValue(':genre', $genre);
			$statement->bindValue(':image', $canvasimg);
			$statement->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the SQL.
			$statement->execute();
			header("Location: feed.php");
		}
	}

	else if ($_REQUEST['command'] == 'Delete') {
		$query     = "DELETE FROM posts WHERE postID = :id";
		$statement = $db->prepare($query);

		$statement->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the SQL.
		$statement->execute();

		header("Location: feed.php");
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>error</title>
</head>
<body>
	<h1>An error occured while processing your post - <?= $_SESSION['username']?>.</h1>

	<p><?= $pieceName ?></p>
	<p><?= $description ?></p>
	<p><?= $genre ?></p>
	<p><?= $canvasimg ?></p>

	<a href="feed.php">Return Home</a>
</body>
</html>