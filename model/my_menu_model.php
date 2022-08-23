<?php

include_once '../commons/my_db_connection.php';
$dbConnectObj = new dbconnection();

class my_menu_model{
    public function getAllCat() 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM menu";
        $result = $conn->query($sql);
        return $result;
    }
    public function getAllItems($cat_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM menu_items i RIGHT OUTER JOIN menu m ON i.cat_id = m.cat_id WHERE i.cat_id = '$cat_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function getItems($item_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM menu_items WHERE item_id = '$item_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function getCartItems($cart_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM cart WHERE cart_id = '$cart_id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addToCart($user_id, $item_id, $item_image, $item_name, $size, $chicken_addon, $egg_addon, $remarks, $unit_price, $quantity,  $sub_total) 
    {
        $conn = $GLOBALS["con"];
        $sql = "INSERT INTO cart(user_id, item_id, item_image, item_name, portion_size, chicken_addon, egg_addon, remarks, unit_price, quantity, sub_total)
                VALUES ('$user_id', '$item_id', '$item_image', '$item_name', '$size', '$chicken_addon', '$egg_addon', '$remarks', '$unit_price', '$quantity', '$sub_total')";
        $result = $conn->query($sql);// or die(mysqli_error($conn));
        $insert_id=$conn->insert_id;
        return $insert_id;
        
    }
    public function checkCart($user_id, $item_id) 
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND item_id = '$item_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function getsub_total($cart_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "SELECT sub_total FROM cart WHERE cart_id = '$cart_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function deleteMenuItem($cart_id, $user_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "DELETE FROM cart WHERE cart_id='$cart_id' AND user_id='$user_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function deletecart($user_id)
    {
        $conn = $GLOBALS["con"];
        $sql = "DELETE FROM cart WHERE user_id='$user_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function getSize($item_id){
        $conn = $GLOBALS["con"];
        $sql = "SELECT small_price, regular_price FROM menu_items WHERE item_id='$item_id'";
        $result = $conn->query($sql);
        return $result;
    }
            
    
    
}



