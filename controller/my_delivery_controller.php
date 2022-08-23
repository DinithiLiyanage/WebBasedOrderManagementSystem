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
        $d_incharge = $_POST["user_id"];
    break;
    default :
        ?>
        <script>window.location="../view/my_manager_delivery.php"</script>
        <?php
    break;
}
