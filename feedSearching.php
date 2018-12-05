<?php
require 'connect.php';

if (!empty($_POST['id'])) {
	

	$cid = $_POST['id'];

	if ($_POST) {

		switch ($cid) {
			case 'Newest':
			$query = "SELECT * FROM posts ORDER BY dateSubmitted DESC";

			$statement = $db->prepare($query);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				$currentUser = $row['userID'];

				$query2 = "SELECT username FROM users WHERE userID = :currentUser";
				$statement2 = $db->prepare($query2);
				$statement2->bindValue(':currentUser', $currentUser);
				$statement2->execute();

				$userRow = $statement2->fetch();

				?>
				<ul style="background-color: lightgrey; text-align:center;">
					<h2><a href="view.php?id=<?= $row['postID'] ?>"><?= $row['pieceName'] ?> </a> BY : <?= $userRow['username'] ?></h2>
					<?php echo '<img src="data:image/png;base64,'.base64_encode( $row['pieceImage']  ).'"width=900 border="8"/>'; ?>
					<p>Description : <?= $row['description'] ?></p>
					<p>Genre: <?= $row['genre'] ?></p>
					<p>Date Created : <?= $row['dateSubmitted'] ?></p>
				</ul>			
				<?php
			}
			break;

			case 'Popular':
			$query = "SELECT * FROM posts ORDER BY pieceName";

			$statement = $db->prepare($query);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				$currentUser = $row['userID'];

				$query2 = "SELECT username FROM users WHERE userID = :currentUser";
				$statement2 = $db->prepare($query2);
				$statement2->bindValue(':currentUser', $currentUser);
				$statement2->execute();

				$userRow = $statement2->fetch();

				?>
				<ul style="background-color: lightgrey; text-align:center;">
					<h2><a href="view.php?id=<?= $row['postID'] ?>"><?= $row['pieceName'] ?> </a> BY : <?= $userRow['username'] ?></h2>
					<?php echo '<img src="data:image/png;base64,'.base64_encode( $row['pieceImage']  ).'"width=900 border="8"/>'; ?>
					<p>Description : <?= $row['description'] ?></p>
					<p>Genre: <?= $row['genre'] ?></p>
					<p>Date Created : <?= $row['dateSubmitted'] ?></p>
				</ul>
				<?php
			}
			break;

			case 'Rating':
			$query = "SELECT * FROM posts ORDER BY pieceName DESC";

			$statement = $db->prepare($query);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				$currentUser = $row['userID'];

				$query2 = "SELECT username FROM users WHERE userID = :currentUser";
				$statement2 = $db->prepare($query2);
				$statement2->bindValue(':currentUser', $currentUser);
				$statement2->execute();

				$userRow = $statement2->fetch();

				?>
				<ul style="background-color: lightgrey; text-align:center;">
					<h2><a href="view.php?id=<?= $row['postID'] ?>"><?= $row['pieceName'] ?> </a> BY : <?= $userRow['username'] ?></h2>
					<?php echo '<img src="data:image/png;base64,'.base64_encode( $row['pieceImage']  ).'"width=900 border="8"/>'; ?>
					<p>Description : <?= $row['description'] ?></p>
					<p>Genre: <?= $row['genre'] ?></p>
					<p>Date Created : <?= $row['dateSubmitted'] ?></p>
				</ul>
				<?php
			}
			break;

			default:

			?>
			<p>Showing results for : <?= $cid ?></p>		
			<?php

			$query = "SELECT * FROM posts WHERE pieceName LIKE '%$cid%' OR description LIKE '%$cid%' OR genre LIKE '%$cid%'";

			$statement = $db->prepare($query);
			$statement->bindValue(':search', $cid);
			$statement->execute();

			while ($row = $statement->fetch()) {	

				$currentUser = $row['userID'];

				$query2 = "SELECT username FROM users WHERE userID = :currentUser";
				$statement2 = $db->prepare($query2);
				$statement2->bindValue(':currentUser', $currentUser);
				$statement2->execute();

				$userRow = $statement2->fetch();

				?>
				<ul style="background-color: lightgrey; text-align:center;">
					<h2><a href="view.php?id=<?= $row['postID'] ?>"><?= $row['pieceName'] ?> </a> BY : <?= $userRow['username'] ?></h2>
					<?php echo '<img src="data:image/png;base64,'.base64_encode( $row['pieceImage']  ).'"width=900 border="8"/>'; ?>
					<p>Description : <?= $row['description'] ?></p>
					<p>Genre: <?= $row['genre'] ?></p>
					<p>Date Created : <?= $row['dateSubmitted'] ?></p>
				</ul>

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
