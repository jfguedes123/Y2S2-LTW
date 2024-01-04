<?php
  require_once(dirname(__DIR__)."/classes/user.php");
  require_once(dirname(__DIR__)."/view/loginpage.php");
  require_once(dirname(__DIR__)."/database/connection.php");
  
  $error = 0;
  $dbh = getDatabaseConnection();

  if(!empty($_POST)){
    $user_to_check = (new User())->set_username($_POST["username"])->set_pass($_POST["password"]);
    $error = $user_to_check->verify_login($dbh);
    if($error == 0){
      session_start();
      $_SESSION["user"] = $user_to_check;
      header('Location: index.php');
      exit();
    }
  }
  
  drawLoginPage($error);
?>