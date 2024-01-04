<?php
require_once(dirname(__DIR__)."/database/connection.php");

class Comment{
    private $ticket;
    private $time;
    private $sender;
    private $comment;

    public function set_ticket($to_set){
        $this->ticket = $to_set;
        return $this;
    }

    public function set_time($to_set){
        $this->time = $to_set;
        return $this;
    }

    public function set_sender($to_set){
        $this->sender = $to_set;
        return $this;
    }

    public function set_comment($to_set){
        $this->comment = $to_set;
        return $this;
    }

    public function get_ticket(){
        return $this->ticket;
    }

    public function get_time(){
        return $this->time;
    }

    public function get_sender(){
        return $this->sender;
    }

    public function get_comment(){
        return $this->comment;
    }

    public function create_comment($dbh){
        try {
            $stmt = $dbh->prepare('INSERT INTO Comment (ticket, time_, sender, comment) VALUES (?, ?, ?, ?)');

            $stmt->execute(array($this->ticket, $this->time, $this->sender, $this->comment));
        } catch (PDOException $e) {
            return 1; //database error
        }
    }
}