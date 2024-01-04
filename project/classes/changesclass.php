<?php
require_once(dirname(__DIR__)."/database/connection.php");
require_once("changeclass.php");
require_once("utils.php");

class Changes{
    private $changes = array();

    public function __construct($dbh, $id){
        $toAdd = return_changes($dbh, $id);
        foreach($toAdd as $change){
            $this->changes[] = (new Change())->set_ticket($change["ticket"])
                                             ->set_time($change["time_"])
                                             ->set_change($change["change"]);
        }
    }

    public function show_changes(){
        echo "<ul>";
        foreach($this->changes as $change){
                echo "<li>" . $change->get_change() . " (" . date("jS \of F Y - h:i:s A",$change->get_time()) . ")</li>";
        }
        echo "</ul><br>";
    }
}