<?php

include_once '../commons/my_db_connection.php';
$dbConnectObj = new dbconnection();

class my_module_model{
    public function getAllModules($role_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM role_module r RIGHT OUTER JOIN module m ON r.module_id = m.module_id WHERE r.role_id = '$role_id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    
}



