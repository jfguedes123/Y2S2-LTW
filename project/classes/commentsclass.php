<?php
require_once(dirname(__DIR__)."/database/connection.php");
require_once("commentclass.php");
require_once("utils.php");

class Comments{
    private $comments = array();

    public function __construct($dbh, $id){
        $toAdd = return_comments($dbh, $id);
        foreach($toAdd as $comment){
            $this->comments[] = (new Comment())->set_ticket($comment["ticket"])
                                               ->set_time($comment["time_"])
                                               ->set_sender($comment["sender"])
                                               ->set_comment($comment["comment"]);
        }
    }

    public function show_comments(){ 
        echo "<div class=chat>";
        echo "<ul>";
        foreach($this->comments as $comment){ //switch tag on "!here!"
            echo "<li><a href=profile.php?username=" . $comment->get_sender() . ">" . $comment->get_sender() . "</a>   " . date(", jS \of F Y - h:i:s A",$comment->get_time()) . ": " . $comment->get_comment() ."</li>";
        }
        echo "</ul><br>";
        echo "</div>";
    }
}