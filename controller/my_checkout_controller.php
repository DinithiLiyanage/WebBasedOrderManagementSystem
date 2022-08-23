<?php
include '../commons/my_session.php';
include '../model/my_menu_model.php';
$menuObj = new my_menu_model();

include_once '../model/my_order_model.php';
$orderObj = new my_order_model();

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_customer_menu.php"</script>
    <?php
}


$status = $_GET["status"];
switch($status)
{
    case "checkout":
        
        $userid = $_POST["user_id"];
        $notes = $_POST["notes"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $cno1 = $_POST["cno1"];
        $method = $_POST["deliverymethod"];
        if($method == "delivery"){
            $pick_method = "d";
        }
        if($method == "pickup"){
            $pick_method = "p";
        }
        $order_id = $orderObj ->addOrder($userid, $fname, $lname, $cno1, $pick_method, $notes);
        
        
        $_SESSION["order"]= $order_id;
        
        if(isset($_SESSION["cart"])){
            $arrLen = count($_SESSION["cart"]);
            for($x=0; $x<$arrLen ; $x++){
                $cartResult = $menuObj ->getCartItems($_SESSION["cart"][$x]);
                $cartrow = $cartResult->fetch_assoc();
                $item_id = $cartrow["item_id"];
                $item_name = $cartrow["item_name"];
                $size = $cartrow["portion_size"];
                $chicken_addon = $cartrow["chicken_addon"];
                $egg_addon = $cartrow["egg_addon"];
                $remarks = $cartrow["remarks"];
                $unit_price = $cartrow["unit_price"];
                $quantity = $cartrow["quantity"];
                $sub_total = $cartrow["sub_total"];
                
                $order_itemid = $orderObj ->addOrderItems($order_id, $item_id, $item_name, $size, $chicken_addon, $egg_addon, $remarks, $unit_price, $quantity, $sub_total);
                
            }
        }
        $sub_total =0;
        $subTotalResult = $orderObj ->getsub_total($order_id);
        while($subTotalRow = $subTotalResult->fetch_assoc()){
            $sub_total += $subTotalRow["sub_total"];
        }
        
        
        if($method == "delivery")
        {
            $d_fname = $_POST["d_fname"];
            $d_lname = $_POST["d_lname"];
            $d_address = $_POST["d_address"];
            $d_city = $_POST["d_city"];
            $d_cno1 = $_POST["d_cno1"];
            
            $delivery_id = $orderObj ->addDeliveryOrder($order_id, $userid, $d_fname, $d_lname, $d_address, $d_city, $d_cno1);
            $grand_total = $sub_total + 150;
            
        }
        if($method == "pickup")
        {
            $p_fname = $_POST["p_fname"];
            $p_lname = $_POST["p_lname"];
            $p_time = $_POST["p_time"];
            
            $pickup_id = $orderObj ->addPickupOrder($order_id, $userid, $p_fname, $p_lname, $p_time);
            $grand_total = $sub_total;
        }
       
        $insertGrandTotal = $orderObj ->insertGrandTotal($order_id, $grand_total);
       
        if((isset($delivery_id)) || (isset($pickup_id))){ 
            echo 'Rs. ', number_format($grand_total);
            
        }
            
        
                    
      
      
      
      
      
      
        break;
    default:
        break;
}