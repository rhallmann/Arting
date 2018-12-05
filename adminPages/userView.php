<?php
require 'connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM users WHERE userID = :id";
$statement = $db->prepare($query);

$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();

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
	<title> View User</title>
</head>
<body>
	<h1>View User - <?= $_SESSION['username']?></h1>
	<form method='post' action="">
		<input type="submit" value="Logout" name="but_logout">
	</form>
	<ul id="menu">
		<li><a href="feed.php" >Feed</a></li>
		<li><a href="users.php" >Users</a></li>
		<li><a href="register.php" >Create New User</a></li>
	</ul>


	<?php while ($row = $statement->fetch()): ?>

		<h3>Username : <?= $row['username'] ?> </a></h3>
		<p>Email : <?= $row['email'] ?></p>
		<p>User Type : <?= $row['userType'] ?></p>
		<p>Current Password : <?= $row['password'] ?></p>
		<p><a href="editUser.php?id=<?= $row['userID'] ?>">update/delete</a></p>

	<?php endwhile ?>

</body>
</html>