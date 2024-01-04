<?php
  require_once(dirname(__DIR__)."/classes/ticketsclass.php");
  require_once(dirname(__DIR__)."/classes/ticketclass.php");
  require_once(dirname(__DIR__)."/classes/user.php");
  require_once(dirname(__DIR__)."/classes/assignedclass.php");
  require_once(dirname(__DIR__)."/classes/changeclass.php");
  require_once(dirname(__DIR__)."/classes/utils.php");
  require_once(dirname(__DIR__)."/database/connection.php");
  require_once(dirname(__DIR__)."/view/ticketpage.php");
  require_once(dirname(__DIR__)."/view/common.php");
  
  $sess = false;

  session_start();

  if(isset($_SESSION["user"])){
      $sess = true;
      $user = $_SESSION["user"];
  }

    if(isset($_GET["action"])){
        if($_GET["action"]){
        session_destroy();
        $sess = false;
        }
    }

  $dbh = getDatabaseConnection();
  $departments = return_departments($dbh);
  $error = 0;

  if(isset($_POST["title"]) && isset($_POST["importance"]) && isset($_POST["description"]) && isset($_SESSION["user"]) && isset($_POST["department"])){
    $toadd = (new Ticket())->set_id(latest_ticket($dbh)+1)
                           ->set_title($_POST["title"])
                           ->set_importance($_POST["importance"])
                           ->set_stat("sent")
                           ->set_descript($_POST["description"])
                           ->set_time(time())
                           ->set_department($_POST["department"])
                           ->set_submitter($user->get_username());

    $error = $toadd->create_ticket($dbh);

    $assign_none = (new Assigned())->set_assigned($dbh, $toadd_getid)
                                   ->change_assigned($dbh);
  
    $created_ticket = (new Change())->set_ticket($toadd->get_id())
                                    ->set_time($toadd->get_time())
                                    ->set_change("Created")
                                    ->create_change($dbh);                               
  }
  
  $active_tickets = (new Tickets())->set_submitted($dbh, $_SESSION["user"]->get_username());
  $assigned_tickets = (new Tickets())->set_assigned($dbh, $_SESSION["user"]->get_username());
  $department_tickets = (new Tickets())->set_by_department($dbh, $_SESSION["user"]->get_department());
  
  drawheader();
  drawSidenav($sess);
  drawTicketPage($active_tickets, $assigned_tickets, $department_tickets, $departments, $user->get_rank());
  drawFooter();
 
?>