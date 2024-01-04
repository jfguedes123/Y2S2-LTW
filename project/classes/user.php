<?php
require_once("utils.php");

class User{
    private $username;
    private $name;
    private $pass;
    private $email;
    private $rank;
    private $department;

    public function set_to_view($dbh, $username){
        $toSee = user_to_view($dbh, $username);

        $this->set_username($toSee["username"]);
        $this->set_email($toSee["email"]);
        $this->set_rank($toSee["rank"]);
        $this->set_department($toSee["department"]);
        
        return $this;
    }
    
    public function set_username($to_set){
        $this->username = $to_set;
        return $this;
    }

    public function set_name($to_set){
        $this->name = $to_set;
        return $this;
    }
    
    public function set_pass($to_set){
        $this->pass = $to_set;
        return $this;
    }

    public function set_email($to_set){
        $this->email = $to_set;
        return $this;
    }

    public function set_rank($to_set){
        $this->rank = $to_set;
        return $this;
    }

    public function set_department($to_set){
        $this->department = $to_set;
        return $this;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_name(){
        return $this->name;
    }

    public function get_pass(){
        return $this->pass;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_rank(){
        return $this->rank;
    }

    public function get_department(){;
        return $this->department;
    }

    public function add_user($dbh){
        $options = ['cost' => 12];

        $numberN = preg_match('/[0-9]/', $this->name);
        $specialCharsN = preg_match('/[\'^£$%&*()}{@#?><>,|=_+¬-]/', $this->name);

        if(validate_username($this->username) && validate_name($this->name)){ //verify username and name
            return 1;
        }
        if(validate_pass($this->pass)) {
            return 2;
        }
        
        try {
        $stmt = $dbh->prepare('INSERT INTO User VALUES ( ?, ?, ?, ?, ?, ?)');

        $stmt->execute(array($this->username, $this->name, password_hash($this->pass, PASSWORD_DEFAULT, $options), $this->email, $this->rank, $this->department));
        } catch (PDOException $e) {
            echo $e;
            if($e->getCode() == 19){
                return 4; //username already exists
            }
            return 5; //database error
        }
        
        return 0;
    }

    public function verify_login($dbh){
        $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute(array($this->username));
        $user = $stmt->fetch();

        if($user){
            if(password_verify($this->pass, $user['pass'])){
                $this->name = $user['name_'];
                $this->rank = $user['rank'];
                $this->email = $user['email'];
                $this->department = $user['department'];
                return 0;
            }
            return 2;
        }
        return 1;
    }

    public function change_profile($dbh, $old_username){
        $options = ['cost' => 12];

        if(validate_username($this->username)  && validate_name($this->name)){ //verify name and username
            return 1;
        }
        if(validate_pass($this->pass)) { //verify password
            return 2;
        }
        
        $new_hash = password_hash($this->pass, PASSWORD_DEFAULT, $options);
        
        try{
            $stmt = $dbh->prepare('UPDATE User SET username = ?, name_ = ?, pass = ?, email = ? WHERE username = ?');
        
            $stmt->execute(array($this->username, $this->name, $new_hash, $this->email, $old_username));

            $stmt = $dbh->prepare('UPDATE User SET username = ?, name_ = ?, pass = ?, email = ? WHERE username = ?');
        } catch (PDOException $e){
            return 5;
        }
    }

    public function change_rank($dbh, $rank_){
        try{
            $stmt = $dbh->prepare('UPDATE User SET rank = ? WHERE username = ?');
            
            $stmt->execute(array($rank_, $this->username));
            $this->set_rank($rank_);
        } catch (PDOException $e){
            return 5;
        }
    }
}?>