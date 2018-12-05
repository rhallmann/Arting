<?php
// connect to the database server by creating an PDO object
	session_start();
	define('DB_DSN','mysql:host=localhost;dbname=artServer;charset=utf8');
	define('DB_USER','artAdmin');
	define('DB_PASS','arting!');

// add error handing to the previous connection script
	try {
		$db = new PDO(DB_DSN, DB_USER, DB_PASS);
	} catch (PDOException $e) {
		print "Connection Error: " . $e->getMessage();
		die(); // Force execution to stop on errors.
  }
?>
