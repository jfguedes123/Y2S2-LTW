<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/view/common.php');
    require_once(dirname(__DIR__).'/classes/user.php');
    require_once(dirname(__DIR__).'/database/connection.php');
    require_once(dirname(__DIR__).'/view/profilepage.php');

    $dbh = getDatabaseConnection();
    $error = 0;
    $sess = false;
    $mode = false;

    session_start();

    if(isset($_SESSION["user"])){
        $sess = true;
        $user = $_SESSION["user"];
        $viewer = $_SESSION["user"];
    }

    if(isset($_GET["username"])){
        $user = (new User())->set_to_view($dbh, $_GET["username"]);
    }

    if(isset($_POST["edit"])){
        if($_POST["edit"] && $user == $_SESSION["user"]){
            $mode = true;
        }
    }

    if(isset($_POST["adminrankchange"])){
        if(!($_POST["adminrankchange"] == "")){
            $error = $user->change_rank($dbh, $_POST["adminrankchange"]);
        }
    }

    if(isset($_POST["adminrankchange"])){
        if($_POST["adminrankchange"] != ""){
            $error = $user->change_rank($dbh, $_POST["adminrankchange"]);
        }
    }

    if(isset($_POST["username"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])){
        $old_username = $user->get_username();
        $old_name = $user->get_name();
        $old_pass = $user->get_pass();
        $old_email = $user->get_email();
        if($_POST["password"] != $_POST["confirm-password"]){
            $error = 3;
        }
        else{
            if(!($_POST["username"] == "")){
                $user->set_username($_POST["username"]);
            }
            if(!($_POST["name"] == "")){
                $user->set_name($_POST["name"]);
            }
            if(!($_POST["email"] == "")){
                $user->set_email($_POST["email"]);
            }
            if(!($_POST["password"] == "")){
                $user->set_pass($_POST["password"]);
            }
            
            $error = $user->change_profile($dbh, $old_username);
        }
        if($error != 0){
            $mode = true;
            $user->set_username($old_username);
            $user->set_name($old_name);
            $user->set_pass($old_pass);
            $user->set_email($old_email);
        }
    }

    if(isset($_GET["action"])){
        if($_GET["action"]){
        session_destroy();
        $sess = false;
        }
    }


    drawHeader();
    drawSidenav($sess);
    drawUserPage($user, $mode, $viewer, $error);
    drawFooter();

?>