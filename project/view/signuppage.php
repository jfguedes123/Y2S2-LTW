<?php 
function drawsignuppage($error, $departments){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../css/login_signupstyle.css">

        <title>Signup page</title>
    </head>
    
    <body>
        <h1><u>uTicket</u></h1>
        <h3>Welcome!</h3>
        <h3>Thanks for the trust!</h3>
        <form action="signup.php" method=post>
            <?php
            switch ($error) { //error messages
                case 1:
                    echo "<span class=error>Username must have between 1 and 10 characters and contain no special characters</span>";
                    break;
                case 2:
                    echo "<span class=error>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</span>";
                    break;
                case 3:
                    echo "<span class=error>Password different from confirmation</span>";
                    break;
                case 4:
                    echo "<span class=error>Username already exists</span>";
                    break;
                case 5:
                    echo "<span class=error>Database error</span>";
                    break;
            }
            ?>
            <label class="username" for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            <label class="name" for="name">Name:</label>
            <input type="text" id="name" name="name"><br><br>
            <label class="email" for="email">E-mail:</label>
            <input type="email" id="email" name="email"><br><br>
            <label class="department" for="department">Department:</label>
            <select name="department">
            <?php
                foreach($departments as $department){
                    echo '<option value="' . $department['department'] . '">' . $department['department'] . '</option>';
                }
            ?>
            </select><br><br>
            <label class="password" for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <label class="password" for="confirm-password">Repeat Password:</label>
            <input type="password" id="confirm-password" name="confirm-password"><br><br>
            <button type="submit">Submit</button>
        </form>
        <p class="login">Have an account? <a href="login.php">Login!</a></p>
    </body>
    </html>
    <?php
}
?>