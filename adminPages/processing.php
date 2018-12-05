<?php
require 'connect.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$confpassword = filter_input(INPUT_POST, 'confpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$usertype = filter_input(INPUT_POST, 'userTypes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if(!empty($_SESSION['username'])){

    if ($_REQUEST['command'] == 'register') {

        if ($password == $confpassword){

            $query     = "INSERT INTO users (username, email, password, usertype) VALUES (:username, :email, :password, :usertype)";
            $statement = $db->prepare($query);

            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':usertype', $usertype);
            // Execute the SQL.
            $statement->execute();

            header("Location: users.php");
        }

    }
    elseif ($_REQUEST['command'] == 'update') {

        if ($password == $confpassword) {

            $query     = "UPDATE users SET username = :username, email = :email, password =:password, usertype = :usertype WHERE userID = :id";
            $statement = $db->prepare($query);

            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':usertype', $usertype);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the SQL.
            $statement->execute();

            header("Location: users.php");

        }
    }

    elseif ($_REQUEST['command'] == 'delete') {
        $query     = "DELETE FROM users WHERE userID = :id";
        $statement = $db->prepare($query);

        $statement->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the SQL.
        $statement->execute();

        header("Location: users.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>error</title>
</head>
<body>
    <h1>An error occured while processing your post.</h1>
    <li><?= $id ?></li>
    <li><?= $username ?></li>
    <li><?= $email ?></li>
    <li><?= $password ?></li>
    <li><?= $usertype ?></li>
    <li><?= $_REQUEST['command'] ?></li>
</body>
</html>