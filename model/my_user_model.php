<?php

include_once '../commons/my_db_connection.php';
$dbconnectionobj = new dbconnection();

class my_user_model{
    public function getUserRoles() 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM role WHERE NOT role_id = 1";
        $result = $conn->query($sql);
        return $result;
        
    }
    public function addUserLogin($user_email) 
    {
        $conn = $GLOBALS["con"];
            $password = 'FBM_2022_12';
            $pwd = sha1($password);
            $sql1 = "SELECT user_id FROM user WHERE user_email = '$user_email'";
            $userId = $conn->query($sql1);
            $userid = $userId->fetch_assoc();
            $user_id = $userid["user_id"];
            $sql = "INSERT INTO login(user_email,user_password,user_id)VALUES('$user_email','$pwd','$user_id')";
            $result= $conn->query($sql);
            $insert_id=$conn->insert_id;
            return $insert_id;
    }
    public function addUser($user_fname, $user_lname, $user_email,$user_nic, $user_dob, $user_cno1, $user_cno2, $user_role_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "INSERT INTO user(user_fname,user_lname,user_email,user_cno1,user_cno2,user_nic,user_dob,role_id)VALUES('$user_fname','$user_lname','$user_email','$user_cno1','$user_cno2','$user_nic',$user_dob,'$user_role_id')";
        $result = $conn->query($sql);
        $insert_id=$conn->insert_id;
        return $insert_id;
    }
    public function getUserDetails($user_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
        $result = $conn->query($sql);
        return $result;
        
    }
    public function changePassword($user_id, $user_password)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE login SET user_password ='$user_password' WHERE user_id='$user_id'";
        $result= $conn->query($sql);
        return $result;
    }
    public function getPassword($user_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM login WHERE user_id = '$user_id'";
        $result = $conn->query($sql);
        return $result;
        
    }
    public function changeProfile($user_id, $user_fname,$user_lname,$user_email,$user_address,$cno1,$cno2,$nic)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE user SET user_fname ='$user_fname',
                                user_lname ='$user_lname',
                                user_email ='$user_email',
                                user_address ='$user_address',
                                user_cno1 ='$cno1',
                                user_cno2 ='$cno2',
                                user_nic ='$nic' WHERE user_id='$user_id'";
        $result= $conn->query($sql);
        return $result;
    }
    public function changeLogin($user_id, $user_email)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE login SET user_email ='$user_email' WHERE user_id='$user_id'";
        $result= $conn->query($sql);
        return $result;
        
    }
    public function getAllUsers() 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM user u, role r WHERE u.role_id = r.role_id AND u.role_id > 1";
        $result = $conn->query($sql);
        return $result;
    }
    public function getActiveCustomers() 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS Activecount FROM user WHERE user_status = 1 AND role_id = 1";
        $result = $conn->query($sql);
        return $result;
    }
    public function getDeactiveCustomers() 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS Deactivecount FROM user WHERE user_status = 0 AND role_id = 1";
        $result = $conn->query($sql);
        return $result;
    }
    public function getDeliveryPpl() 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM user WHERE role_id = 3";
        $result = $conn->query($sql);
        return $result;
        
    }
}
