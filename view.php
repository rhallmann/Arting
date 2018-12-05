<?php
require 'connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM posts WHERE postID = :id";
$statement = $db->prepare($query);

$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();

$post;

?>

<!DOCTYPE html>
<html>
<head>
	<title> View Posting</title>
</head>
<body>
	<h1>Single post</h1>
	
	<a href="loginPages/loginHub.php">login/register</a>
	<ul id="menu">
		<li><a href="index.php" >Homepage</a></li>
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

		<li><?= $row['pieceName'] ?> BY : <?= $userRow['username'] ?></li>
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['pieceImage']  ).'"/>'; ?>
		<li><?= $row['description'] ?></li>
		<li><?= $row['genre'] ?></li>
		<li><?= $row['dateSubmitted'] ?></li>

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

		<li><?= $userRow['username'] ?></li>
		<li><?= $row['comment']?></li>
		<li>Posted : <?= $row['dateSubmitted'] ?></li>

	<?php endwhile ?>

	</body>
	</html>