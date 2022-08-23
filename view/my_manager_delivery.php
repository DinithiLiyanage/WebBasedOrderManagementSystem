<?php
    include '../commons/my_session.php';
    include '../model/my_order_model.php';
    $orderObj = new my_order_model();
    $getDeliveryResults = $orderObj ->getDeliveries();
    
    
    $getDelivererResult = $orderObj -> getActiveDeliverers();
    
    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        
    </head>
    <body style="background-color: #F5F5F5; color: #808080;">
        <div class="container-fluid">
            <?php
                if($_SESSION["user"]["role_id"]== 1){
                    include '../includes/my_customer_heading.php';
                }
                else{
                    include '../includes/my_staff_heading.php';
                }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <table class="table " id="deliverytable">
                        <thead>
                            <tr>
                                
                                <th>Delivery ID</th>
                                <th>Order ID</th>
                                <th>Invoice Date</th>
                                <th>City</th>
                                <th>Assignment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($getDeliveryRow = $getDeliveryResults->fetch_assoc())
                                {
                                    if(isset($getDeliveryRow["payment_date"]))
                                    {
                                        
                            ?>
                            <tr>
                                <td><?php echo $getDeliveryRow["delivery_id"];?></td>
                                <td><?php echo $getDeliveryRow["order_id"];?></td>
                                <td><?php echo $getDeliveryRow["payment_date"];?></td>
                                <td><?php echo $getDeliveryRow["d_city"];?></td>
                                <td <?php if($getDeliveryRow["assignment_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($getDeliveryRow["assignment_status"]==1)
                                    {
                                    ?>
                                    Assigned - 
                                    <?php
                                        $getInChargeResults = $orderObj ->getDeliveryInCharge($getDeliveryRow["d_incharge"]);
                                        $getInChargeRow = $getInChargeResults -> fetch_assoc();
                                        echo $getInChargeRow["user_fname"],' ',$getInChargeRow["user_lname"];
                                    }
                                    else{
                                        ?>
                                        Pending
                                        
                                        <form action="../controller/my_delivery_controller.php?status=addInCharge" method="post">
                                        <select class="form-control" name="user_id" id="user_id" required="required">
                                            <option value="">---</option>
                                            <?php
                                                while($getDelivererRow= $getDelivererResult->fetch_assoc())
                                                {
                                            ?>
                                            <option value=" <?php echo $getDelivererRow["user_id"]; ?>">
                                                <?php
                                                    echo $getDelivererRow["user_fname"],' ',$getDelivererRow["user_lname"];
                                                ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </td>
                            
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>



