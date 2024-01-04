<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/view/common.php');
    require_once(dirname(__DIR__).'/classes/user.php');
    require_once(dirname(__DIR__).'/classes/usersclass.php');
    require_once(dirname(__DIR__).'/classes/assignedclass.php');
    require_once(dirname(__DIR__).'/classes/changeclass.php');
    require_once(dirname(__DIR__).'/classes/changesclass.php');
    require_once(dirname(__DIR__).'/classes/commentclass.php');
    require_once(dirname(__DIR__).'/classes/commentsclass.php');
    require_once(dirname(__DIR__).'/classes/ticketclass.php');
    require_once(dirname(__DIR__).'/classes/utils.php');
    require_once(dirname(__DIR__).'/database/connection.php');
    require_once(dirname(__DIR__).'/view/problempage.php');

    $dbh = getDatabaseConnection();
    $departments = return_departments($dbh);
    $errorM = 0;
    $errorC = 0;
    $errorA = 0;
    $sess = false;

    session_start();

    if(isset($_SESSION["user"])){
        $sess = true;
        $rank = $_SESSION["user"]->get_rank();
    }

    if(isset($_GET["id"])){
        
        $id = $_GET["id"];
        
        if(isset($_POST["message"])){
            $comment = (new Comment())->set_ticket($_GET["id"])
                                      ->set_time(time())
                                      ->set_sender($_SESSION["user"]->get_username())
                                      ->set_comment($_POST["message"]);

            $errorM = $comment->create_comment($dbh);
        }

        $ticket = return_ticket($dbh, $id);

        $ticket = (new Ticket())->set_id($ticket["id"])
                                ->set_title($ticket["title"])
                                ->set_importance($ticket["importance"])
                                ->set_stat($ticket["stat"])
                                ->set_descript($ticket["descript"])
                                ->set_time($ticket["time_"])
                                ->set_department($ticket["department"])
                                ->set_submitter($ticket["submitter"]);

        $agents = (new Users())->set_agents_from_department($dbh, $ticket->get_department());

        $assigned = (new Assigned())->set_assigned($dbh, $ticket->get_id());

        if(isset($_POST["importance"]) && isset($_POST["status"]) && isset($_POST["department"]) && isset($_POST["assign"])){
            $old_importance = $ticket->get_importance();
            $old_status = $ticket->get_status();
            $old_department = $ticket->get_department();
            $old_agent = $assigned->get_agent();
            
            $change_time = time();

            if(!($_POST["importance"] == "")){
                $ticket->set_importance($_POST["importance"]);
                $changed_importance = (new Change())->set_ticket($ticket->get_id())
                                                    ->set_time($change_time)
                                                    ->set_change("Changed importance to " . $ticket->get_importance());
            }
            if(!($_POST["status"] == "")){
                $ticket->set_stat($_POST["status"]);
                $changed_status = (new Change())->set_ticket($ticket->get_id())
                                                    ->set_time($change_time + 1)
                                                    ->set_change("Changed status to " . $ticket->get_status());
            }
            if(!($_POST["assign"] == "")){
                $assigned->set_agent($_POST["assign"]);
                $changed_assigned = (new Change())->set_ticket($ticket->get_id())
                                                ->set_time($change_time + 2)
                                                ->set_change("Assigned " . $_POST["assign"]);
            }
            if(!($_POST["department"] == "")){
                $ticket->set_department($_POST["department"]);
                $ticket->set_importance($old_importance);
                $ticket->set_stat("sent");
                $changed_department = (new Change())->set_ticket($ticket->get_id())
                                                    ->set_time($change_time)
                                                    ->set_change("Change department to " . $ticket->get_department());
            }

            $errorC = $ticket->change_ticket($dbh);
            $errorA = $assigned->change_assigned($dbh);

            if($errorC != 0){
                $ticket->set_importance($old_importance);
                $ticket->set_status($old_status);
                $ticket->set_department($old_department);
            } else if($errorA != 0){
                $assigned->set_agent($old_agent);
            }else{
                if(!isset($change_department)){
                    if(isset($changed_importance)){
                        $changed_importance->create_change($dbh);
                    }
                    if(isset($change_status)){
                        $changed_status->create_change($dbh);
                    }
                    if(isset($change_assigned)){
                        $changed_assigned->create_change($dbh);
                    }
                }
                else{
                    $change_department->create_change($dbh);
                }
            }
        }

        $changes = new Changes($dbh, $ticket->get_id());

        $comments = new Comments($dbh, $ticket->get_id());
    }

    drawHeader();
    drawSidenav($sess);
    drawProblemPage($ticket, $comments, $departments, $rank, $changes, $agents->get_users(), $assigned->get_agent());
    drawFooter();
?>