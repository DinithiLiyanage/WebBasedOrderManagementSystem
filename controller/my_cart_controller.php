<?php
include '../commons/my_session.php';
include '../model/my_menu_model.php';
$menuObj = new my_menu_model();

if(isset($_GET["remove"])){
    $cart_id = $_GET["remove"];
    $user_id = $_SESSION["user"]["user_id"];
    $deleteItemResult = $menuObj ->deleteMenuItem($cart_id, $user_id);
    $arrlen = count($_SESSION["cart"]);
    for($x=0; $x<$arrlen; $x++){
        if($_SESSION["cart"][$x] == $cart_id){
            array_splice($_SESSION["cart"], $x,1);
        }
    }
    ?>
    <script>window.location="../view/my_shopping_cart.php"</script>
    <?php
}
if(isset($_GET["clear"])){
    $user_id = $_SESSION["user"]["user_id"];
    $deleteCartResult = $menuObj->deletecart($user_id);
    $_SESSION["cart"] = array();
    ?>
    <script>window.location="../view/my_customer_menu.php"</script>
    <?php
}