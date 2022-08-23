<?php

include_once '../commons/my_db_connection.php';
$dbconnectionobj = new dbconnection();

class my_signup_model{
    public function addUser($user_fname, $user_lname, $user_email, $user_cno1, $user_role_id)
        {
            $conn = $GLOBALS["con"];
            $sql = "INSERT INTO user(user_fname,user_lname,user_email,user_cno1,role_id)VALUES('$user_fname','$user_lname','$user_email','$user_cno1','$user_role_id')";
            $result= $conn->query($sql);
            return $result;
            

        }
    public function addLogin($user_email, $user_password)
        {
            $conn = $GLOBALS["con"];
            $sql1 = "SELECT user_id FROM user WHERE user_email = '$user_email'";
            $userId = $conn->query($sql1);
            $userid = $userId->fetch_assoc();
            $user_id = $userid["user_id"];
            $sql = "INSERT INTO login(user_email,user_password,user_id)VALUES('$user_email','$user_password','$user_id')";
            $result= $conn->query($sql);
            return $result;
            

        }
}