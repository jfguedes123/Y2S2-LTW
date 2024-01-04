<?php 
function drawLoginPage(int $error){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../css/login_signupstyle.css">

        <title>Login page</title>
    </head>
    
    <body>
        <h1><u>uTicket</u></h1>
        <h3>Efficience and Readiness</h3>

        <h4>Login</h4>
        <?php if($error == 1){
            echo("error 1");
        }
        if($error == 2){
            echo("error 2");
        }?>
        <form action="login.php" method="post">
            <label class="username" for = "username">Username:</label>
            <input type = "text" id = "username" name = "username"><br><br>
            <label class="password" for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <button type="submit">Submit</button>
        </form>

        <p class="signup">Still have no account? <a href="signup.php">Signup!</a></p>

    </body>
    </html>
<?php
}
?>