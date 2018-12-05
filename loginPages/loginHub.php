<!DOCTYPE html>
<html>
<head>
    <title>login</title>
</head>
<body>
    <div class="container">
        <form action="processing.php" method="post">
            <div id="div_login">
                <h1>Login</h1>
                <div>
                    <label for="username">username</label>
                    <input name="username" id="username" />
                </div>
                <div>
                    <label for="password">password</label>
                    <input name="password" id="password" />
                </div>
                <div>
                    <a href="register.php">Register</a>
                </div>
                <div>
                    <input type="submit" name="but_submit" value="login" />
                </div>
            </div>
        </form>
    </div>
</body>
</html>