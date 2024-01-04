<?php
require_once(dirname(__DIR__)."/database/connection.php");

function return_submitted_tickets($dbh, $sub){
    $stmt = $dbh->prepare('SELECT * FROM Ticket WHERE submitter = :user ORDER BY time_ ASC');
    
    $stmt->bindParam(':user', $sub);

    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function return_department_tickets($dbh, $department){
    $stmt = $dbh->prepare('SELECT * FROM Ticket WHERE department = :department ORDER BY time_ ASC');
    
    $stmt->bindParam(':department', $department);

    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function return_department_users($dbh, $department){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE department = :department');
    
    $stmt->bindParam(':department', $department);

    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function return_assigned_tickets($dbh, $agent){
    $stmt = $dbh->prepare('SELECT * FROM Ticket JOIN (SELECT * FROM ASSIGNED WHERE user = :agent ) WHERE ticket = id ORDER BY time_ ASC');
    
    $stmt->bindParam(':agent', $agent);

    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function return_ticket($dbh, $id){
    $stmt = $dbh->prepare('SELECT * FROM Ticket WHERE id = :id');

    $stmt->bindParam(':id', $id);

    $stmt->execute();
    
    $result = $stmt->fetch();
    
    return $result;
}

function return_changes($dbh, $ticket){
    $stmt = $dbh->prepare('SELECT * FROM Change WHERE ticket = :ticket ORDER BY time_ ASC');
    
    $stmt->bindParam(':ticket', $ticket);

    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function return_comments($dbh, $ticket){
    $stmt = $dbh->prepare('SELECT * FROM Comment WHERE ticket = :ticket');
    
    $stmt->bindParam(':ticket', $ticket);

    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function return_departments($dbh){
    $stmt = $dbh->prepare('SELECT * FROM Department');
    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function user_to_view($dbh, $username){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE username = :username');
    
    $stmt->bindParam(':username', $username);
    $stmt->execute();
        
    $result = $stmt->fetch();
    return $result;
}

function return_assigned($dbh, $id){
    $stmt = $dbh->prepare('SELECT * FROM Assigned WHERE ticket = :ticket');
    
    $stmt->bindParam(':ticket', $ticket);
    $stmt->execute();
        
    $result = $stmt->fetch();
    return $result;
}

function return_hashtags($dbh, $ticket){
    $stmt = $dbh->prepare('SELECT * FROM Hashtag JOIN (SELECT * FROM Has WHERE ticket = :ticket) WHERE tag = tag_');
    
    $stmt->bindParam(':ticket', $ticket);

    $stmt->execute();
        
    $result = $stmt->fetchAll();
    return $result;
}

function latest_ticket($dbh){
    $stmt = $dbh->prepare('SELECT MAX(id) AS "id" FROM Ticket');

    $stmt->execute();
     
    $result = $stmt->fetch();
    return $result['id'];
}

function validate_name($name){
    $numberN = preg_match('/[0-9]/', $this->name);
    $specialCharsN = preg_match('/[\'^£$%&*()}{@#?><>,|=_+¬-]/', $this->name);
    
    return !$numberN && !$specialCharsN;
}

function validate_username($username){
    $size_check = strlen($username);
    $specialCharsU = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username);
    
    return !($size_check > 0 && $size_check <= 10) && !$specialCharsU;
}

function validate_pass($pass){
    $size_check = strlen($pass);
    $uppercaseP = preg_match('/[A-Z]/', $pass);
    $lowercaseP = preg_match('/[a-z]/', $pass);
    $numberP = preg_match('/[0-9]/', $pass);
    $specialCharsP = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $pass);
    
    return !$uppercaseP || !$lowercaseP || !$numberP || !$specialCharsP || $size_check < 8;
}
?>