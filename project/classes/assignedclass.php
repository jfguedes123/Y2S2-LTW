<?php
require_once("utils.php");

class Assigned{
    private $agent;
    private $ticket;

    public function set_assigned($dbh, $id){
        $toSee = return_assigned($dbh, $id);
        if(!empty($toSee)){
            $this->agent = $toSee["user"];
            $this->ticket = $toSee["ticket"];
        }
        else{
            $this->agent = "None";
            $this->ticket = "id";
        }

        return $this;
    }

    public function set_agent($to_set){
        $this->agent = $to_set;
        return $this;
    }

    public function set_ticket($to_set){
        $this->agent = $to_set;
        return $this;
    }

    public function get_agent(){
        return $this->agent;
    }

    public function get_ticket(){
        return $this->ticket;
    }

    public function change_assigned($dbh){
        try{
            if($this->agent == "None"){
                $stmt = $dbh->prepare('INSERT INTO Assigned VALUES ( ?, ?)');
            } else{
                $stmt = $dbh->prepare('UPDATE Assigned SET user = ? WHERE ticket = ?');
            }

            $stmt->execute(array($this->agent, $this->ticket));
        } catch (PDOException $e){
            return 5;
        }
    }
}

?>