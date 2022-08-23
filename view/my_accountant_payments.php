<?php
    include '../commons/my_session.php';
    include '../model/my_order_model.php';
    $orderObj = new my_order_model();
    $getPaymentResults = $orderObj ->getPaymentDetails();
    
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
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Invoice Date</th>
                                <th>Order ID</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Approval Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($getPaymentRow = $getPaymentResults->fetch_assoc())
                                {
                                    
                            ?>
                            <tr>
                                <td><?php echo $getPaymentRow["user_id"];?></td>
                                <td><?php echo $getPaymentRow["fname"],' ',$getPaymentRow["lname"];?></td>
                                <td><?php echo $getPaymentRow["payment_date"];?></td>
                                <td><?php echo $getPaymentRow["order_id"];?></td>
                                <td><?php echo $getPaymentRow["pay_method"];?></td>
                                <td>LKR <?php echo number_format($getPaymentRow["grand_total"]);?></td>
                                <td <?php if($getPaymentRow["approval_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($getPaymentRow["approval_status"]==1)
                                    {
                                    ?>
                                    Approved
                                    <?php
                                    }
                                    else{
                                        ?>
                                        Pending
                                        <a href="../controller/my_payment_controller.php?approveorder=<?php echo $getPaymentRow["order_id"];?>" class="approveorder" >
                                        <button type="button"  class="btn btn-default btn-success" style="text-align: center;">
                                            Approve
                                        </button></a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="my_generate-invoice-report.php" class="btn btn-primary">
                                Generate User Report
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>
