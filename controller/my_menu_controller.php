<?php
include '../commons/my_session.php';
if($_SESSION["user"]["role_id"] == 1){
    if(!isset($_GET["status"]))
    {
        ?>
        <script>window.location="../view/my_customer_menu.php"</script>
        <?php
    }
}
else{
    if(!isset($_GET["status"]))
    {
        ?>
        <script>window.location="../view/my_manager_menu.php"</script>
        <?php
    }
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
    
            case "addnewpromo":
            $promo_image = $_POST["promo_image"];
            $promo_heading = $_POST["promo_heading"];
            $promo_descript = $_POST["promo_description"];
            
            try{
                if($promo_heading == "")
                {
                    throw new Exception("Promotional Heading can't be empty");
                }
                if($promo_image == "")
                {
                    throw new Exception("Promotional image can't be empty");
                }
                
                $promo_id = $menuObj ->addPromo($promo_image, $promo_heading, $promo_descript);
                ?>
                   <Script> window.location= "../view/my_manager_menu.php" </script> 
                <?php
                
                
            } catch (Exception $ex){
         
            $msg= $ex->getMessage();
            $msg= base64_encode($msg);

            ?>
                <Script> window.location= "../view/my_add_promo.php?msg=<?php echo $msg; ?>" </script> 
            <?php
            }
        
        break;
        case "addnewitem":
            $cat_id = $_POST["item_cat"];
            $item_name = $_POST["item_name"];
            $item_image = $_POST["item_image"];
            $small_price = $_POST["small_price"];
            $regular_price = $_POST["regular_price"];
            $chicken_addon = $_POST["chicken_addon"];
            $egg_addon = $_POST["egg_addon"];
            $item_descript = $_POST["item_description"];
            
            try{
                if($cat_id == "")
                {
                    throw new Exception("Category can't be empty");
                }
                if($item_name == "")
                {
                    throw new Exception("Item Name can't be empty");
                }
                if($item_image == "")
                {
                    throw new Exception("Item image can't be empty");
                }
                if($small_price == "")
                {
                    throw new Exception("Small portion price can't be empty");
                }
                if($regular_price == "")
                {
                    throw new Exception("Regular portion price can't be empty");
                }
                
                $item_id = $menuObj ->addToMenuItems($cat_id, $item_name, $item_image, $small_price, $regular_price, $chicken_addon, $egg_addon, $item_descript);
                ?>
                   <Script> window.location= "../view/my_manager_menu.php" </script> 
                <?php
                
                
            } catch (Exception $ex){
         
            $msg= $ex->getMessage();
            $msg= base64_encode($msg);

            ?>
                <Script> window.location= "../view/my_add_item.php?msg=<?php echo $msg; ?>" </script> 
            <?php
            }
        
        break;
        
        case "changedescript":
            $item_id = $_POST["item_id"];
            $item_name = $_POST["item_name"];
            $small_price = $_POST["small_price"];
            $regular_price = $_POST["regular_price"];
            $chicken_addon = $_POST["chicken_addon"];
            $egg_addon = $_POST["egg_addon"];
            $item_descript = $_POST["item_description"];
            
            $changeDescript = $menuObj ->changeDescript($item_id, $item_name, $small_price, $regular_price, $chicken_addon, $egg_addon, $item_descript);
            
            ?>
                <Script> window.location= "../view/my_manager_menu.php" </script> 
            <?php
            
        break;
        case "editcart":
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
            
            $cartChange = $menuObj -> changeCart($user_id, $item_id, $item_image, $item_name, $size, $chicken_addon, $egg_addon, $remarks, $unit_price, $quantity,  $sub_total);
            ?>
            <script>window.location="../view/my_shopping_cart.php"</script>
            <?php
        break;
    
    default:
        ?>
            <script>window.location="../view/my_dashboard.php"</script>
        <?php
        break;

}
if(isset($_GET["remove"])){
    $promo_id = $_GET["remove"];
    $deletePromo = $userObj ->deletePromo($promo_id);
    $arrlen = count($_SESSION["cart"]);
    
    ?>
    <script>window.location="../view/my_manager_menu.php"</script>
    <?php
}





