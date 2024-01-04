<?php
require_once("../database/connection.php");
require_once("ticketclass.php");
require_once("utils.php");

class Tickets{
    private $tickets = array();

    public function set_submitted($dbh, $name){
        $toAdd = return_submitted_tickets($dbh, $name);
        foreach($toAdd as $ticket){
            $this->tickets[] = (new Ticket())->set_id($ticket["id"])
                                             ->set_title($ticket["title"])
                                             ->set_importance($ticket["importance"])
                                             ->set_stat($ticket["stat"])
                                             ->set_descript($ticket["descript"])
                                             ->set_time($ticket["time_"])
                                             ->set_department($ticket["department"])
                                             ->set_submitter($ticket["submitter"]);
        }
        return $this;
    }

    public function set_by_department($dbh, $department){
        $toAdd = return_department_tickets($dbh, $department);
        foreach($toAdd as $ticket){
            $this->tickets[] = (new Ticket())->set_id($ticket["id"])
                                             ->set_title($ticket["title"])
                                             ->set_importance($ticket["importance"])
                                             ->set_stat($ticket["stat"])
                                             ->set_descript($ticket["descript"])
                                             ->set_time($ticket["time_"])
                                             ->set_department($ticket["department"])
                                             ->set_submitter($ticket["submitter"]);
        }
        return $this;
    }

    public function set_assigned($dbh, $assigned){
        $toAdd = return_assigned_tickets($dbh, $assigned);
        foreach($toAdd as $ticket){
            $this->tickets[] = (new Ticket())->set_id($ticket["id"])
                                             ->set_title($ticket["title"])
                                             ->set_importance($ticket["importance"])
                                             ->set_stat($ticket["stat"])
                                             ->set_descript($ticket["descript"])
                                             ->set_time($ticket["time_"])
                                             ->set_department($ticket["department"])
                                             ->set_submitter($ticket["submitter"]);
        }
        return $this;
    }

    public function show_active(){ 
        echo '<div class=activeinfo>';
        echo "<ul>";
        foreach($this->tickets as $ticket){
            $status = $ticket->get_status();
            if($status == 'sent' || $status == 'picked'){
                echo "<li> ----------------------------------------------------------------"
                . "<br>ID: <a href=problem.php?id=" . $ticket->get_id() . ">" . $ticket->get_id() . "</a>"
                . "<br>Importance: " . $ticket->get_importance() 
                . "<br>Problem: " . $ticket->get_descript() 
                . "<br>Date: " . date("jS \of F Y; h:i:s A",$ticket->get_time()) 
                . "<br> ---------------------------------------------------------------- "
                . "</li>";
            }
        }
        echo "</ul><br>";
        echo "</div>";
    }

    public function show_solved(){
        echo "<div class=solvedinfo>";
        echo "<ul>";
        foreach($this->tickets as $ticket){
            $status = $ticket->get_status();
            if($status == 'solved'){
                echo "<li> ----------------------------------------------------------------"
                . "<br>ID: <a href=problem.php?id=" . $ticket->get_id() . ">" . $ticket->get_id() . "</a>"
                . "<br>Importance: " . $ticket->get_importance() 
                . "<br>Problem: " . $ticket->get_descript() 
                . "<br>Date: " . date("jS \of F Y; h:i:s A",$ticket->get_time()) 
                . "<br> ---------------------------------------------------------------- "
                . "</li>";
            }
        }
        echo "</ul><br>";
        echo "</div>";
    }

    public function gettickets(){
        return $this->tickets;
    }
}?>