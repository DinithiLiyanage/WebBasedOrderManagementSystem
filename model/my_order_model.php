<?php

include_once '../commons/my_db_connection.php';
$dbConnectObj = new dbconnection();

class my_order_model{
    public function addOrderItems($order_id, $cart_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "INSERT INTO order_cart(order_id, cart_id)
                VALUES ('$order_id', '$cart_id')";
        $result = $conn->query($sql);// or die(mysqli_error($conn));
        return $result;
        
    }
    public function addOrder($user_id, $fname, $lname, $cno1, $pick_method, $notes) 
    {
        $conn = $GLOBALS["con"];
        $sql = "INSERT INTO order_details(user_id, fname, lname, cno1, pick_method, notes)
                VALUES ('$user_id', '$fname', '$lname', '$cno1', '$pick_method', '$notes')";
        $result = $conn->query($sql);// or die(mysqli_error($conn));
        $insert_id = $conn->insert_id;
        return $insert_id;
        
    } 
   
    public function addDeliveryOrder($order_id, $d_fname, $d_lname, $d_address, $d_city, $d_cno1) 
    {
        $conn = $GLOBALS["con"];
        $sql = "INSERT INTO delivery(order_id, d_fname, d_lname, d_address, d_city, d_cno1)
                VALUES('$order_id', '$d_fname', '$d_lname', '$d_address', '$d_city', '$d_cno1')";
        $result = $conn->query($sql)or die(mysqli_error($conn));
        $insert_id=$conn->insert_id;
        return $insert_id;
    }
    public function addPickupOrder($order_id,$p_fname, $p_lname, $p_time) 
    {
        $conn = $GLOBALS["con"];
        $sql = "INSERT INTO pickup(order_id, p_fname, p_lname,p_time)
                VALUES('$order_id', '$p_fname', '$p_lname', '$p_time')";
        $result = $conn->query($sql)or die(mysqli_error($conn));
        $insert_id=$conn->insert_id;
        return $insert_id;
    }
    public function getsub_total($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT sub_total FROM order_cart o, cart c WHERE o.order_id = '$order_id' AND o.cart_id = c.cart_id";
        $result = $conn->query($sql);
        return $result;
    }
    public function insertGrandTotal($order_id, $grand_total)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE order_details SET grand_total = '$grand_total' WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getgrand_total($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT grand_total FROM order_details WHERE order_id = '$order_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function insertPaymentMethod($order_id, $date, $method)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE order_details SET pay_method = '$method', payment_date = '$date'  WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getPaymentDetails()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM order_details";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function approveOrder($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE order_details SET approval_status = 1  WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getAllDeliveries()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM delivery d, order_details o WHERE d.order_id = o.order_id AND o.preparation_status = 1";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getDeliveries($d_incharge)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM delivery d, order_details o WHERE d.order_id = o.order_id AND d_incharge = '$d_incharge' ";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function assignOrder($delivery_id, $user_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE delivery SET assignment_status = 1,d_incharge = '$user_id'  WHERE delivery_id = '$delivery_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getDeliveryInCharge($d_incharge)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM user WHERE user_id = '$d_incharge' ";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getActiveDeliverers()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM user u, login l WHERE u.user_id = l.user_id AND u.role_id =3  AND l.login_status = 1";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function acceptOrder($delivery_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE delivery SET acceptance_status = 1 WHERE delivery_id = '$delivery_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function dispatchOrder($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE delivery SET dispatch_status = 1 WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function completeOrder($delivery_id,$order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE delivery SET completion_status = 1 WHERE delivery_id = '$delivery_id'";
        $sql2 = "UPDATE order_details SET completion_status = 1 WHERE order_id = '$order_id' ";
        $result1 = $conn->query($sql) or die(mysqli_error($conn));
        $result2 = $conn->query($sql2) or die(mysqli_error($conn));
        return $result1;
    }
    public function getOrders($user_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM order_details ORDER BY payment_date WHERE user_id = '$user_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getOrderDetails($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM order_details WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getOrderItems($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM order_cart o, cart c WHERE o.order_id = '$order_id' AND o.cart_id = c.cart_id ";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getDelivery($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM delivery WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getPickup($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM pickup WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getApprovedOrders()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM order_details WHERE approval_status = 1 ";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    
    public function finishOrder($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE order_details SET preparation_status = 1 WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function collectOrder($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "UPDATE order_details SET pickup_status = 1 WHERE order_id = '$order_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function completePickOrder($order_id)
    {
        $conn = $GLOBALS["con"];
        $sql1 = "UPDATE order_details SET completion_status = 1 WHERE order_id = '$order_id'";
        $sql2 = "UPDATE pickup SET pickup_status = 1 WHERE order_id = '$order_id'";
        $result1 = $conn->query($sql1) or die(mysqli_error($conn));
        $result2 = $conn -> query($sql2) or die(mysqli_error($conn));
        return $result1;
        return $result2;
    }
    public function getAnyOrder()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM order_details";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getFinishedOrders()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT *  FROM order_details WHERE completion_status = 1";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function deleteItem($item_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "DELETE FROM menu_items WHERE item_id = '$item_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    
    
}

