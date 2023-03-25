<?php
include '../commons/my_session.php';
include '../model/my_order_model.php';
$orderObj = new my_order_model();

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_manager_delivery.php"</script>
    <?php
}

$status = $_GET["status"];
switch($status)
{
    case "addInCharge":
        $delivery_id = $_POST["delivery_id"];
        $d_incharge = $_POST["user_id"];
        $assignResult = $orderObj ->assignOrder($delivery_id, $d_incharge);
        
        ?>
        <script>window.location="../view/my_manager_delivery.php"</script>
        <?php
        
    break;
    case "accept":
        $delivery_id = $_POST["delivery_id"];
        $acceptResult = $orderObj ->acceptOrder($delivery_id);
        
        ?>
        <script>window.location="../view/my_delivery_delivery.php"</script>
        <?php
        
    break;
    
    case "complete":
        $order_id = $_POST["order_id"];
        $delivery_id = $_POST["delivery_id"];
        $assignResult = $orderObj ->completeOrder($delivery_id,$order_id);
        
        ?>
        <script>window.location="../view/my_delivery_delivery.php"</script>
        <?php
        
    break;
    default :
        ?>
        <script>window.location="../view/my_delivery_delivery.php"</script>
        <?php
    break;
}
