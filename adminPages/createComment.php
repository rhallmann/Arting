<?php
require '../loginPages/connect.php';

$userID      = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_NUMBER_INT);
$postID      = filter_input(INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT);
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($_REQUEST['command'] == 'Comment') {
	if ((!empty($comment))) {

		$query     = "INSERT INTO comments (postID, userID, comment) VALUES (:postID, :userID, :comment)";
		$statement = $db->prepare($query);

		$statement->bindValue(':userID', $userID);
		$statement->bindValue(':postID', $postID);
		$statement->bindValue(':comment', $comment);

		$statement->execute();

		header( "Location: view.php? id=$postID");
	}
}
?>