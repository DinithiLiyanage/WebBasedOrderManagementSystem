<?php
include '../commons/my_session.php';

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_customer_menu.php"</script>
    <?php
}

include_once  "../model/my_menu_model.php";

$menuObj  = new my_menu_model();

$status = $_GET["status"];
switch($status)
{
    
    case "additemtocart":
            
            $item_id = $_POST["item_id"];
            $item_name = $_POST["item_name"];
            $item_image = $_POST["item_image"];
            $user_id = $_POST["user_id"];
            $size = $_POST["size"];
            $quantity = $_POST["quantity"];
            $remarks = $_POST["remarks"];

            $chicken_addon = $_POST["chicken_addon"];
            $egg_addon = $_POST["egg_addon"];
            
            
            
            $unit_price = $size + $chicken_addon + $egg_addon;
            $sub_total = $unit_price * $quantity;
            
            
            $checkResult = $menuObj ->checkCart($user_id, $item_id);
            $checkRow = $checkResult ->fetch_assoc();
            $old_cart_id = isset($checkRow["cart_id"]);
                    
                    
            if(!($old_cart_id)){
                $cart_id = $menuObj -> addToCart($user_id, $item_id, $item_image, $item_name, $size, $chicken_addon, $egg_addon, $remarks, $unit_price, $quantity, $sub_total);
                if($cart_id >0){
                    $cartItemResult = $menuObj ->getCartItems($cart_id);
                    $cartIdRow = $cartItemResult -> fetch_assoc();
                    if(!isset($_SESSION["cart"]))
                    {
                        $_SESSION["cart"] = array();
                        $_SESSION["cart"][] = $cartIdRow["cart_id"];
                    } else {
                            
                        $_SESSION["cart"][] = $cartIdRow["cart_id"];
                    }
                        ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" >x</button>
                            <strong>Item added to your cart</strong>
                        </div>
                        <?php
                        
                        
                        
                }else{
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" >x</button>
                            <strong>Something went wrong </strong>
                        </div>
                    <?php
                }
            }else{
                ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" >x</button>
                            <strong>Item already exists in cart</strong>
                        </div>
                <?php
            }
          
            break;
    
    default:
        ?>
            <script>window.location="../view/my_dashboard.php"</script>
        <?php
        break;

}





