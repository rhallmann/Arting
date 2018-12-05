<?php
require 'connect.php';

if (!empty($_POST['id'])) {
	
	$query = "SELECT * FROM usertypes ORDER BY userType DESC";

	$statement = $db->prepare($query);
	$statement->execute();

	while ($row = $statement->fetch()) {
		?>
		<option value="<?= $row['userType'] ?>"><?= $row['typeName']?></option>

		<?php
	}
}
?>
