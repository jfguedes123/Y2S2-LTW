<?php

declare(strict_types=1);

function drawHeader()
{ ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>uTicket</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css"> 
        <link href="../css/layout.css" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <h1><u id="h1">uTicket</u></h1>
        </div>
<?php
}

function drawSidenav($mode)
{ ?>
    <div class="sidenav">
        <div class = "signup">
        <?php if ($mode) { ?>
            <a href="ticket.php">Tickets</a>
            <a href="profile.php">Account</a>
            <a href="about.php">About</a>
            <a href="index.php?action=1?">Logout</a>
         <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        <?php } ?>
        </div>
    </div>
<?php }


function drawFooter() { ?>
    <div class = "footer">
        <p id="copy">&copy; 2023 uTicket</p>
    </div>
  </body>
</html>
<?php }

?>