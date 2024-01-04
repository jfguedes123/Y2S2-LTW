<?php

declare(strict_types=1);
require_once(dirname(__DIR__) . '/view/common.php');
require_once(dirname(__DIR__) . '/classes/user.php');
require_once(dirname(__DIR__) . '/database/connection.php');
require_once(dirname(__DIR__) . '/view/profilepage.php');
require_once(dirname(__DIR__) . '/view/aboutpage.php');

$sess = false;

session_start();

if (isset($_SESSION["user"])) {
    $sess = true;
}

if (isset($_GET["action"])) {
    if ($_GET["action"]) {
        
        session_destroy();
        $sess = false;
    }
}

drawheader();
drawSidenav($sess);
drawAboutPage();
drawfooter();
?>