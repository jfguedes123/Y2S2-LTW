<?php
  require_once(dirname(__DIR__)."/view/indexpage.php");
  require_once(dirname(__DIR__)."/view/aboutpage.php");
  require_once(dirname(__DIR__)."/classes/user.php");
  require_once(dirname(__DIR__)."/database/connection.php");
  require_once(dirname(__DIR__)."/view/common.php");
  require_once(dirname(__DIR__)."/classes/ticketsclass.php");

  $sess = false;
  
  session_start();

  if(isset($_SESSION["user"])){
    $sess = true;
  }

  if(isset($_GET["action"])){
    if($_GET["action"]){
      session_destroy();
      $sess = false;
    }
  }

  drawheader();
  drawSidenav($sess);
  drawindexpage();
  drawfooter();
?>

  