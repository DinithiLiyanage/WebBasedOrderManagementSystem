<?php
    include '../commons/my_session.php';
    include '../model/my_order_model.php';
    $orderObj = new my_order_model();
    include '../model/my_menu_model.php';
    $menuObj = new my_menu_model();
    
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
                    <table class="table " id="ordertable">
                        <thead>
                            <tr>
                                
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Portion Size</th>
                                <th>Chicken Add On</th>
                                <th>Egg Add On</th>
                                <th>Pickup Method</th>
                                <th>Preparation Status</th>
                                <th>Pickup Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orderResult = $orderObj ->getApprovedOrders();
                                while($orderRow = $orderResult->fetch_assoc())
                                {
                                    
                                    $itemResult = $orderObj ->getOrderItems( $orderRow["order_id"]);
                                    while($itemRow = $itemResult -> fetch_assoc())
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $orderRow["order_id"];?></td>
                                        <td><?php echo $itemRow["item_name"];?></td>
                                        <td><?php echo $itemRow["quantity"];?></td>
                                        
                                        <td><?php
                                                        $item_id = $itemRow["item_id"];
                                                        $size = $itemRow["portion_size"];
                                                        $sizeResult = $menuObj ->getSize($item_id);
                                                        $sizerow = $sizeResult->fetch_assoc();
                                                        if($sizerow["small_price"] == $size){
                                                            echo 'Small';
                                                        };
                                                        if($sizerow["regular_price"] == $size){
                                                            echo 'Regular';
                                                        };

                                        ?></td>
                                        <td> <?php if(!empty($itemRow["chicken_addon"])){?>
                                                <span class="glyphicon glyphicon-ok"></span>
                                            <?php
                                            
                                            }else{
                                            ?>
                                                <span class="glyphicon glyphicon-remove"></span>
                                            <?php } ?>
                                            
                                        </td>
                                        <td> <?php if(!empty($itemRow["egg_addon"])){?>
                                                <span class="glyphicon glyphicon-ok"></span>
                                            <?php
                                            
                                            }else{
                                            ?>
                                                <span class="glyphicon glyphicon-remove"></span>
                                            <?php } ?>
                                        </td>                   
                                    
                                        <td><?php echo $orderRow["pick_method"];?></td>
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
                                                Preparing
                                                <form action="../controller/my_order_controller.php?status=finish" method="post">
                                                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $orderRow["order_id"];?>">
                                            
                                                    <button type="submit" style="display: inline-block;" class="btn btn-success">Ready</button>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td <?php if($orderRow["pickup_status"]==1 && $orderRow["preparation_status"]==1){?> class="success" <?php } ?> >
                                            <?php
                                            if($orderRow["pickup_status"]==1 && $orderRow["preparation_status"]==1)
                                            {
                                                if($orderRow["pick_method"] == "p")
                                                {
                                                ?>
                                                Collected
                                                <?php
                                                }
                                                else{
                                                    $deliveryResult = $orderObj ->getDelivery($orderRow["order_id"]);
                                                    $deliveryRow = $deliveryResult -> fetch_assoc();
                                                    if($deliveryRow["acceptance_status"] == 1){
                                                ?>
                                                Dispatched
                                                <?php
                                                    }
                                                }
                                            }else{
                                                ?>
                                                Pending
                                                <form action="../controller/my_order_controller.php?status=collect" method="post">
                                                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $orderRow["order_id"];?>">
                                                    <input type="hidden" id="pick_method" name="pick_method" value="<?php echo $orderRow["pick_method"];?>">
                                            
                                                    <button type="submit" style="display: inline-block;" class="btn btn-success">Collected</button>
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
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    
    <!-- include bootstrap js -->
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    
    <script src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $(#ordertable).DataTable();
        });
    </script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
</html>


