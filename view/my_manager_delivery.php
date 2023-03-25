<?php
    include '../commons/my_session.php';
    include '../model/my_order_model.php';
    $orderObj = new my_order_model();
    $getDeliveryResults = $orderObj ->getAllDeliveries();
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
                                <th>Acceptance Status</th>
                                <th>Dispatch Status</th>
                                <th>Completion Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($getDeliveryRow = $getDeliveryResults->fetch_assoc())
                                {
                                    if($getDeliveryRow["preparation_status"] == 1)
                                    {
                                        
                            ?>
                            <tr>
                                <td><?php echo $getDeliveryRow["delivery_id"];?></td>
                                <td><?php echo $getDeliveryRow["order_id"];?></td>
                                <td><?php echo $getDeliveryRow["payment_date"];?></td>
                                <td><?php echo $getDeliveryRow["d_city"];?></td>
                                <td <?php if($getDeliveryRow["assignment_status"]==1){?> class="success" <?php } ?> >
                                    
                                    <?php
                                    if($getDeliveryRow["assignment_status"]==1){
                                        $getInChargeResults = $orderObj ->getDeliveryInCharge($getDeliveryRow["d_incharge"]);
                                        $getInChargeRow = $getInChargeResults -> fetch_assoc();
                                        echo $getInChargeRow["user_fname"],' ',$getInChargeRow["user_lname"];
                                    }
                                    else{
                                        ?>
                                        
                                        <form action="../controller/my_delivery_controller.php?status=addInCharge" method="post">
                                            <input type="hidden" id="delivery_id" name="delivery_id" value="<?php echo $getDeliveryRow["delivery_id"];?>">
                                            
                                            <select class="form-control" style="display: inline-block;" name="user_id" id="user_id" required="required">
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
                                            <button type="submit" style="display: inline-block;" class="btn btn-success">Assign</button>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td <?php if($getDeliveryRow["acceptance_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($getDeliveryRow["acceptance_status"]==1)
                                    {
                                    ?>
                                    Accepted
                                    <?php
                                    }
                                    elseif($getDeliveryRow["acceptance_status"]==2){
                                    ?>
                                    Accepted
                                    <?php    
                                    }
                                    else{
                                        ?>
                                        Pending
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td <?php if($getDeliveryRow["dispatch_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($getDeliveryRow["dispatch_status"]==1)
                                    {
                                    ?>
                                    Dispatched
                                    <?php
                                    }
                                    else{
                                        ?>
                                        Pending
                                        
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td <?php if($getDeliveryRow["completion_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($getDeliveryRow["completion_status"]==1)
                                    {
                                    ?>
                                    Completed
                                    <?php
                                    }
                                    else{
                                        ?>
                                        Pending
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
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    
    <!-- include bootstrap js -->
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    
    <script src="../js/datatable/jquery-3.5.1.js"></script>
    
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $document.ready(function(){
            $(#usertable).DataTable();
        });
    </script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
</html>



