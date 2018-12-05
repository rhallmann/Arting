 <?php
 require 'connect.php';

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
  <title>Register</title>
</head>
<body>
    <h1>Register users</h1>

    <form method='post' action="">
        <input type="submit" value="Logout" name="but_logout">
    </form>

    <form action="processing.php" method="post">
        <div>
            <ul id="menu">
                <li><a href="feed.php" >Feed</a></li>
                <li><a href="users.php" >Users</a></li>
            </ul>
            <label for="username">username</label>
            <input name="username" id="username" />
        </div>

        <div>
            <label for="email">email</label>
            <input name="email" id="email" />
        </div>

        <div>
            <label for="password">password</label>
            <input name="password" id="password" />
        </div>

        <div>
            <label for="confpassword">confirm password</label>
            <input name="confpassword" id="confpassword" />
        </div>

        <div>

            <label>User Type</label>
            <select name="userTypes" id="userTypes">
                <?php 

                $query = "SELECT * FROM usertypes ORDER BY userType ASC";

                $statement = $db->prepare($query);
                $statement->execute();

                ?>

                <?php while ($row = $statement->fetch()): ?>

                    <option value="<?= $row['userType'] ?>"><?= $row['typeName']?> : <?= $row['userType'] ?></option>;

                <?php endwhile; ?>

            </select>

        </div>

        <div>
            <input type="submit" name="command" value="register" />
        </div>

    </form>
</body>
</html>