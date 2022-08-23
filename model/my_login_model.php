<?php

include_once '../commons/my_db_connection.php';
$dbConnectObj = new dbconnection();

class my_login_model{
    public function ValidateLogin($username, $password) {
        $pwd = sha1($password);
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM user u, login l WHERE u.user_id = l.user_id AND l.user_email='$username' AND l.user_password='$pwd'";
        $result = $conn -> query($sql);
        return $result;
    
    }
    public function ChangeLoginStatus($username) {
        
        $conn = $GLOBALS["con"];
        $sql = "UPDATE login SET login_status = 1 WHERE user_email='$username'";
        $result = $conn -> query($sql);
        return $result;
    
    }
    public function UserLogout($username) {
        
        $conn = $GLOBALS["con"];
        $sql = "UPDATE login SET login_status = 0 WHERE user_email='$username'";
        $result = $conn -> query($sql);
        return $result;
    
    }
    
    
}


