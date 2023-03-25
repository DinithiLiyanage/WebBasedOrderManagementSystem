<?php
include '../commons/my_session.php';
include '../model/my_order_model.php';
$orderObj = new my_order_model();

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_staff_order.php"</script>
    <?php
}

$status = $_GET["status"];
switch($status)
{
    case "finish":
        $order_id = $_POST["order_id"];
        $finishResult = $orderObj ->finishOrder($order_id);
        
        ?>
        <script>window.location="../view/my_staff_order.php"</script>
        <?php
        
    break;
    case "collect":
        $order_id = $_POST["order_id"];
        $pick_method = $_POST["pick_method"];
        $collectResult = $orderObj ->collectOrder($order_id);
        
        if($pick_method == "p"){
            $completeResult = $orderObj -> completePickOrder($order_id);
        }
        else{
            $dispatchResult = $orderObj ->dispatchOrder($order_id);
        }
        ?>
        <script>window.location="../view/my_staff_order.php"</script>
        <?php
        
    break;
    
    default :
        ?>
        <script>window.location="../view/my_delivery_delivery.php"</script>
        <?php
    break;
    
}
if(isset($_GET["remove"])){
    $item_id = $_GET["remove"];
    $deleteItem = $orderObj ->deleteItem($item_id);
    
    
    ?>
    <script>window.location="../view/my_manager_menu.php"</script>
    <?php
}



