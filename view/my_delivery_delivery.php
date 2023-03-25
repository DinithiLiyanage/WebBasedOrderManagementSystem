<?php
    include '../commons/my_session.php';
    include '../model/my_order_model.php';
    $orderObj = new my_order_model();
    $getDeliveryResults = $orderObj ->getDeliveries($_SESSION["user"]["user_id"]);
    
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
                    <table class="table " id="invoicetable">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Delivery Address</th>
                                <th>City</th>
                                <th>Contact Number</th>
                                <th>Acceptance Status</th>
                                <th>Completion Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($getDeliveryRow = $getDeliveryResults->fetch_assoc())
                                {
                                    if($getDeliveryRow["approval_status"] == 1)
                                    {
                                        
                            ?>
                            <tr>
                                <td><?php echo $getDeliveryRow["order_id"];?></td>
                                <td><?php echo $getDeliveryRow["payment_date"];?></td>
                                <td><?php echo $getDeliveryRow["fname"],' ',$getDeliveryRow["lname"];?></td>
                                <td><?php echo $getDeliveryRow["d_address"];?></td>
                                <td><?php echo $getDeliveryRow["d_city"];?></td>
                                <td><?php echo $getDeliveryRow["d_cno1"];?></td>
                                <td <?php if($getDeliveryRow["acceptance_status"]==1){?> class="success" <?php } ?> >
                                    
                                    <?php
                                    if($getDeliveryRow["acceptance_status"]==1)
                                    {
                                    ?>
                                    Accepted
                                    <?php
                                    }
                                    else{
                                        ?>
                                        
                                        <form action="../controller/my_delivery_controller.php?status=accept" method="post">
                                            <input type="hidden" id="delivery_id" name="delivery_id" value="<?php echo $getDeliveryRow["delivery_id"];?>">
                                            
                                            <button type="submit" style="display: inline-block;" class="btn btn-success">Accept</button>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </td>
                                
                                <td <?php if($getDeliveryRow["completion_status"]==1 && $getDeliveryRow["pickup_status"]==1){?> class="success" <?php } ?> >
                                    
                                    <?php
                                    if($getDeliveryRow["completion_status"]==1 && $getDeliveryRow["pickup_status"]==1)
                                    {
                                    ?>
                                    Completed
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <form action="../controller/my_delivery_controller.php?status=complete" method="post">
                                            <input type="hidden" id="delivery_id" name="delivery_id" value="<?php echo $getDeliveryRow["delivery_id"];?>">
                                            <input type="hidden" id="order_id" name="order_id" value="<?php echo $getDeliveryRow["order_id"];?>">
                                            
                                            <button type="submit" style="display: inline-block;" class="btn btn-success">Complete</button>
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

