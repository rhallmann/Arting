<?php
 require 'connect.php';
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Register</title>
 </head>
 <body>
 	<div class="container">
        <form action="processing.php" method="post">
            <div id="div_register">
                <h1>Register</h1>
                <div>
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
                    <input type="submit" name="but_submit" value="register" />
                </div>
            </div>
        </form>
    </div>
 </body>
 </html>