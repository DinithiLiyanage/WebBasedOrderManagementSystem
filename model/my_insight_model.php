<?php

include_once '../commons/my_db_connection.php';
$dbConnectObj = new dbconnection();

class my_insight_model{
    public function getRevenue()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT SUM(grand_total) AS Income, YEAR(payment_date) AS payment_date FROM order_details GROUP BY YEAR(payment_date)";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getOrderCount()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT
                    MONTH(payment_date) AS month,
                    COUNT(order_id) AS count
                FROM order_details
                GROUP BY
                    MONTH(payment_date)";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getItemCount()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT
                    item_id,
                    item_name,
                    SUM(quantity) AS count
                FROM cart
                GROUP BY
                    item_id";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getCartCount($item_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(order_id) AS count FROM cart c RIGHT OUTER JOIN order_cart o
                ON c.cart_id = o.cart_id WHERE c.item_id = '$item_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getTotOrders()
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(order_id) AS count FROM order_details";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    public function getTotIncome($item_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT SUM(sub_total) AS count FROM cart c WHERE c.item_id = '$item_id'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    
}

