<?php
require_once(dirname(__DIR__)."/database/connection.php");

class Change{
    private $ticket;
    private $time;
    private $change;

    public function set_ticket($to_set){
        $this->ticket = $to_set;
        return $this;
    }

    public function set_time($to_set){
        $this->time = $to_set;
        return $this;
    }

    public function set_change($to_set){
        $this->change = $to_set;
        return $this;
    }

    public function get_time(){
        return $this->time;
    }

    public function get_change(){
        return $this->change;
    }

    public function create_change($dbh){
        try {
            $stmt = $dbh->prepare('INSERT INTO Change (ticket, time_, change) VALUES (?, ?, ?)');

            $stmt->execute(array($this->ticket, $this->time, $this->change));
        } catch (PDOException $e) {
            return 1; //database error
        }
    }
}