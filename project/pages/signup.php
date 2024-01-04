<?php
  require_once(dirname(__DIR__)."/classes/user.php");
  require_once(dirname(__DIR__)."/classes/utils.php");
  require_once(dirname(__DIR__)."/view/signuppage.php");
  require_once(dirname(__DIR__)."/database/connection.php");
  
  $error = 0; //0->no error; 1->invalid name; 2->invalid pass; 3->pass different from confirm; 4->username exists; 5->database error
  $dbh = getDatabaseConnection();
  $departments = return_departments($dbh);

  if(!empty($_POST)){
    if($_POST["password"] == $_POST["confirm-password"]){
      $user_to_check = (new User())->set_username($_POST["username"])
                                  ->set_name($_POST["name"])
                                  ->set_email($_POST["email"])
                                  ->set_pass($_POST["password"])
                                  ->set_rank("client")
                                  ->set_department($_POST["department"]);
      $error = $user_to_check->add_user($dbh);
      if($error == 0){
        session_start();
        $_SESSION["user"] = $user_to_check;
        header('Location: index.php');
        exit();
      }
    }
    else{
      $error = 3; //password != confirm_password
    }
  }
  
  drawsignuppage($error, $departments);
?>