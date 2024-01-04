<?php
require_once("../database/connection.php");
require_once("user.php");
require_once("utils.php");

class Users{
    private $users = array();

    public function set_agents_from_department($dbh, $department){
        $toAdd = return_department_users($dbh, $department);
        foreach($toAdd as $user){
            if($user["rank"] == "agent" || $user["rank"] == "admin"){
                $this->users[] = (new User())->set_username($user["username"])
                                         ->set_rank($user["rank"])
                                         ->set_email($user["email"])
                                         ->set_department($user["department"]);
            }
        }
        return $this;
    }

    public function show_users_username(){
        echo "<ul>";
        foreach($this->users as $user){
            echo "<li><a href=profile.php?userToView=" . $user->get_username() . ">" .  $user->get_username() . "</a></li>";
        }
        echo "</ul><br>";
    }

    public function get_users(){
        return $this->users;
    }
}
?>