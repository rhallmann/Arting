<?php
require 'connect.php';

if (!empty($_POST['id'])) {
	

	$cid = $_POST['id'];

	if ($_POST) {

		switch ($cid) {
			case 'Type':
			$query = "SELECT * FROM users ORDER BY userType ASC";

			$statement = $db->prepare($query);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				?>
				<h3>Username : <a href="userView.php?id=<?= $row['userID'] ?>"><?= $row['username'] ?> </a></h3>
				<p>Email : <?= $row['email'] ?></p>
				<p>User Type : <?= $row['userType'] ?></p>

				<?php
			}
			break;

			case 'Username':
			$query = "SELECT * FROM users ORDER BY username ASC";

			$statement = $db->prepare($query);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				?>
				<h3>Username : <a href="userView.php?id=<?= $row['userID'] ?>"><?= $row['username'] ?> </a></h3>
				<p>Email : <?= $row['email'] ?></p>
				<p>User Type : <?= $row['userType'] ?></p>

				<?php
			}
			break;

			case 'Email':
			$query = "SELECT * FROM users ORDER BY email ASC";

			$statement = $db->prepare($query);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				?>
				<h3>Username : <a href="userView.php?id=<?= $row['userID'] ?>"><?= $row['username'] ?> </a></h3>
				<p>Email : <?= $row['email'] ?></p>
				<p>User Type : <?= $row['userType'] ?></p>
				<?php
			}
			break;

			default:

			?>
			<p>Showing results for : <?= $cid ?></p>		
			<?php

			$query = "SELECT * FROM users WHERE username LIKE '%$cid%' OR email LIKE '%$cid%'";

			$statement = $db->prepare($query);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				?>
				<h3>Username : <a href="userView.php?id=<?= $row['userID'] ?>"><?= $row['username'] ?> </a></h3>
				<p>Email : <?= $row['email'] ?></p>
				<p>User Type : <?= $row['userType'] ?></p>
				<?php
			}
			break;
		}
	}
}
else {
	?>
	<h2>Something went wrong!!!</h2>
	<?php

	
}
?>
