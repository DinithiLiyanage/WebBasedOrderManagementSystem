<?php
    include '../commons/my_session.php';
    include '../model/my_menu_model.php';
    $menuObj = new my_menu_model();
    if(isset($_GET["msg"]))
    {
        $order_id = $_GET["msg"]; 
        include '../model/my_order_model.php';
        $orderObj = new my_order_model();
        $detailResult = $orderObj ->getOrderDetails($order_id);
        $detailRow = $detailResult ->fetch_assoc();
    }
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
                <div class="col-md-11 col-md-offset-0">
                    <h3 class="h3"> Order ID : <?php echo $detailRow["order_id"] ;?></h3>
                    <h4> Order Date : <?php echo $detailRow["payment_date"] ;?></h4>
                    <h4> Amount : LKR <?php echo $detailRow["grand_total"] ;?> .00</h4>
                    <h4> Payment Method : <?php echo $detailRow["pay_method"] ;?></h4>
                    <h4> Delivery (d)/ In-store Pickup (p) : <?php echo $detailRow["pick_method"] ;?></h4>                      
                    <hr>
                </div>
                
                <div class="col-md-6">
                    <div class="col-md-11 col-md-offset-0">
                            <h3 class="h3"> ORDER SUMMARY</h3>
                            <table class="table " id="usertable">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $itemResult = $orderObj ->getOrderItems($order_id);
                                    while($itemRow = $itemResult -> fetch_assoc()){
                                        ?>
                                        <tr>
                                            <td><?php echo $itemRow["item_name"];?>
                                            <br/>
                                            Portion Size:
                                            <?php
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

                                                ?>
                                            <br/>
                                            <?php if(!empty($itemRow["chicken_addon"])){?>
                                                    Chicken Add-On's: Rs.<?php echo $itemRow["chicken_addon"];}
                                                    if(!empty($itemRow["egg_addon"])){?><br>
                                                    Egg Add-On's: Rs.<?php echo $itemRow["egg_addon"];}
                                            ?>
                                            <br/>
                                                <?php if(!empty($itemRow["remarks"])){?>
                                                Special Remarks: <?php echo $itemRow["remarks"];}?>
                                            </td>

                                            <td>Rs.<?php echo number_format($itemRow["unit_price"]);?></td>
                                            <td><?php echo $itemRow["quantity"];?></td>
                                            <td>Rs.<?php echo number_format($itemRow["sub_total"]);?> </td>

                                        </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="col-md-6">
                        <div class="col-md-11 col-md-offset-0">
                            <div class="panel-heading">
                                <h3 class="h3" >Delivery / In-store Pickup Details</h3>
                                <?php 
                                if($detailRow["pick_method"] == 'd'){
                                    $deliveryResult = $orderObj ->getDelivery($order_id);
                                    $deliveryRow = $deliveryResult -> fetch_assoc();
                                    ?>
                                    <p> Name : <?php echo $deliveryRow["d_fname"]," ",$deliveryRow["d_lname"] ;?></p>
                                    <p> Address : <?php echo $deliveryRow["d_address"] ;?> </p>
                                    <p> City : <?php echo $deliveryRow["d_city"] ;?></p>
                                    <p> Contact Number : <?php echo $deliveryRow["d_cno1"] ;?></p>
                                <?php            
                                }else{
                                    $pickupResult = $orderObj ->getPickup($order_id);
                                    $pickupRow = $pickupResult -> fetch_assoc();
                                    ?>
                                    <p> Name : <?php echo $pickupRow["p_fname"]," ",$pickupRow["p_lname"] ;?></p>
                                    <p> Pickup Time : <?php echo $pickupRow["p_time"] ;?> </p>
                                <?php            
                                }
                                ?>


                            </div>
                            <div class="panel-heading">
                                <h3 class="h3">Billing Information</h3>
                                <p> Name : <?php echo $detailRow["fname"]," ", $detailRow["lname"];?> </p>
                                <p> Contact No : <?php echo $detailRow["cno1"];?> </p>
                            </div>
                        </div>
                            
                        <div class="panel-body">
                        </div>
                </div>
            </div>
        </div>
        
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
    
</html>

