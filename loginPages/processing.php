<?php

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$confpassword = filter_input(INPUT_POST, 'confpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if(isset($_REQUEST['but_submit'])){

    require 'connect.php';

    if ($_REQUEST['but_submit'] == 'login') {

        if ($username != "" && $password != ""){

            $query     = "SELECT COUNT(*) AS cntUser FROM users WHERE password = :password AND username = :username";
            $statement = $db->prepare($query);

            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password);
            // Execute the SQL.
            $statement->execute();

            $count = $statement->fetch();

            if($count['cntUser'] > 0){

                $_SESSION['username'] = $username;

                $query = "SELECT userType FROM users WHERE password = :password AND username = :username";
                $statement = $db->prepare($query);

                $statement->bindValue(':username', $username);
                $statement->bindValue(':password', $password);
                // Execute the SQL.
                $statement->execute();

                $validity = $statement->fetch();

                if ($validity['userType'] == 1) {
                    header('Location: ../adminPages/feed.php');
                }
                else{
                    header('Location: ../userPages/feed.php');
                }
            }
            else{
                echo "error invalid username or password";
            }

        }
    }
    elseif ($_REQUEST['but_submit'] == 'register') {

        if ($password == $confpassword){

            $query     = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $statement = $db->prepare($query);

            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':email', $email);
            // Execute the SQL.
            $statement->execute();

            header('Location: ../userPages/feed.php');
        }

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
    <p>Both the title and content must be at least one character.</p>
    <a href="index.php">Return Home</a>
</body>
</html>