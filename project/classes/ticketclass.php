<?php
require_once(dirname(__DIR__)."/database/connection.php");

class Ticket{
    private $id;
    private $title;
    private $importance;
    private $stat;
    private $descript;
    private $time;
    private $submitter;
    private $department;
    private $hashtags = array();

    public function set_id($to_set){
        $this->id = $to_set;
        return $this;
    }

    public function set_title($to_set){
        $this->title = $to_set;
        return $this;
    }

    public function set_importance($to_set){
        $this->importance = $to_set;
        return $this;
    }

    public function set_stat($to_set){
        $this->stat = $to_set;
        return $this;
    }

    public function set_descript($to_set){
        $this->descript = $to_set;
        return $this;
    }

    public function set_time($to_set){
        $this->time = $to_set;
        return $this;
    }

    public function set_department($to_set){
        $this->department = $to_set;
        return $this;
    }

    public function set_submitter($to_set){
        $this->submitter = $to_set;
        return $this;
    }

    public function set_hashtags($dbh){
        $toAdd = return_hashtags($dbh, $id);
        foreach($toAdd as $hashtag){
            $hashtags[] = $hashtag;
        }
        return $this;
    }

    public function get_id(){
        return $this->id;
    }
    
    public function get_title(){
        return $this->title;
    }

    public function get_importance(){
        return $this->importance;
    }

    public function get_descript(){
        return $this->descript;
    }

    public function get_status(){
        return $this->stat;
    }

    public function get_time(){
        return $this->time;
    }

    public function get_department(){
        return $this->department;
    }

    public function get_submitter(){
        return $this->submitter;
    }

    public function create_ticket($dbh){
        try {
            $stmt = $dbh->prepare('INSERT INTO Ticket (id, title, importance, stat, descript, time_, department, submitter) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

            $stmt->execute(array($this->id, $this->title, $this->importance, $this->stat, $this->descript, $this->time, $this->department, $this->submitter));
        } catch (PDOException $e) {
            return 1; //database error
        }
    }

    public function change_ticket($dbh){
        try{
            $stmt = $dbh->prepare('UPDATE Ticket SET importance = ?, stat = ?, department = ? WHERE id = ?');
        
            $stmt->execute(array($this->importance, $this->stat, $this->department, $this->id));
        } catch (PDOException $e){
            return 5;
        }
    }
}
?>