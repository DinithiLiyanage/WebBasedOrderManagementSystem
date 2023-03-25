<?php
    include '../commons/my_session.php';
    include '../model/my_order_model.php';
   
    $orderObj = new my_order_model();
    $orderResult = $orderObj -> getAnyOrder();
    
?> 

<html>
    <head>
        <?php
        include '../includes/my_css_includes.php';
        ?>                    
    </head>
    <body style="background-color:#F5F5F5 ;color: #808080 ">
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
                    <table class="table " id="ordertable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Delivery (d)/ In-store Pickup (p)</th>
                                <th>Approval_status</th>
                                <th>Preparation_status</th>
                                <th>Pickup_status</th>
                                <th>Completion_status</th>
                                <th>Order Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($orderRow = $orderResult -> fetch_assoc())
                                {
                                    
                            ?>
                            <tr>
                                <td><?php echo $orderRow["payment_date"];?></td>
                                <td><?php echo $orderRow["grand_total"] ;?>.00</td>
                                <td><?php echo $orderRow["pay_method"] ;?></td>
                                <td><?php echo $orderRow["pick_method"] ;?></td>
                                <td <?php if($orderRow["approval_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($orderRow["approval_status"]==1)
                                    {
                                    ?>
                                    Approved
                                    <?php
                                    }
                                    else{
                                    ?>
                                    Pending
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td <?php if($orderRow["preparation_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($orderRow["preparation_status"]==1)
                                    {
                                    ?>
                                    Prepared
                                    <?php
                                    }
                                    else{
                                    ?>
                                    Pending
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td <?php if($orderRow["pickup_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($orderRow["pickup_status"]==1)
                                    {
                                    ?>
                                    Picked
                                    <?php
                                    }
                                    else{
                                    ?>
                                    Pending
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td <?php if($orderRow["completion_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($orderRow["completion_status"]==1)
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
                                <td><a href="../view/my_old_orders.php?msg=<?php echo $orderRow["order_id"] ;?>">..>>> </a></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a href="my_generate_order_report.php" class="btn btn-primary">
                        Generate User Report
                    </a>
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
            $(#ordertable).DataTable();
        });
    </script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
</html>