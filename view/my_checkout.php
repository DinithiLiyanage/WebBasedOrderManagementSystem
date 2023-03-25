<?php
    include '../commons/my_session.php';
    include '../model/my_menu_model.php';
    $menuObj = new my_menu_model();
    
    include '../model/my_user_model.php';
    $userObj = new my_user_model();
    
    include_once '../model/my_order_model.php';
    $orderObj = new my_order_model();
    
    $userResult = $userObj -> getUserDetails($_SESSION["user"]["user_id"]);
    $detailRow = $userResult -> fetch_assoc();
    
    
    
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
                <div class="col-md-12" id="alert-message"></div>
            </div>
            
            <div class="col-md-6">
                <div class="col-md-11 col-md-offset-0">
                    <h2 class="h2" style="color: #808080;">Review Your Order</h2>
                    <form action="../controller/my_checkout_controller.php?status=checkout" method="post">
                        <div class="panel panel-default">
                            
                            <div class="panel-heading" style="background-color: #C0C0C0;">
                                <h4 class="h4" style="color: #FFF;">Delivery / In-store Pickup</h4>
                            </div>
                            
                            <div class="panel-body">
                                <input type="hidden" class="user_id"    id="user_id"    name="user_id"    value="<?php echo $_SESSION["user"]["user_id"]; ?>">
                                <input type="radio"  class="deliverymethod" id="deliver"   name="deliverymethod" value="delivery">
                                <label for="deliver">Deliver to given address
                                    (Rs. 150 will be charged additionally for delivery)</label>
                                <br>
                                <input type="radio" class="deliverymethod" id="pickup"  name="deliverymethod" value="pickup" >
                                <label for="pickup">Store pickup</label>
                                <br>
                                <div class="method" id="showdelivery" style="display: none;">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4 class="h4">Delivery Address</h4>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">First Name:</label>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="d_fname" id="d_fname" value="<?php echo $detailRow["user_fname"]; ?>" >
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">&nbsp;</div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Last Name:</label>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="d_lname" id="d_lname" value="<?php echo $detailRow["user_lname"]; ?>" >
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">&nbsp;</div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4 ">
                                                            <label class="control-label">Address:</label>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="d_address" id="d_address" value="" >
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">&nbsp;</div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4 ">
                                                            <label class="control-label">City:</label>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="d_city" id="d_city" value="" >
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">&nbsp;</div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Contact Number:</label>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="d_cno1" id="d_cno1" value="<?php echo $detailRow["user_cno1"]; ?>">
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="method" id="showpickup" style="display: none;">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4 class="h4">Pickup Time</h4>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">First Name:</label>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="p_fname" id="p_fname" value="<?php echo $detailRow["user_fname"]; ?>" >
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">&nbsp;</div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Last Name:</label>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="p_lname" id="p_lname" value="<?php echo $detailRow["user_lname"]; ?>" >
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">&nbsp;</div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Pickup Time (Estimated preparation time - 30 min):</label>
                                                            
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <input type="time" class="form-control" name="p_time" id="p_time" value="" >
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading" style="background-color: #C0C0C0;">
                                <h4 class="h4" style="color: #FFF;">Order Notes </h4>
                            </div>
                            <div class="panel-body">
                                <textarea name='notes' cols="50" rows="2" id="notes" placeholder="Type your instructions here"></textarea> 
                            </div>
                            <div class="panel-heading" style="background-color: #C0C0C0;">
                                <h4 class="h4" style="color: #FFF;">Billing Information</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">First Name:</label>
                                    </div> 
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $detailRow["user_fname"]; ?>" >
                                    </div>
                                </div>
                                                    
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>                    
                                                    
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">Last Name:</label>
                                    </div> 
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $detailRow["user_lname"]; ?>" >
                                    </div>
                                </div>
                                                    
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">Contact Number:</label>
                                    </div> 
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="cno1" id="cno1" value="<?php echo $detailRow["user_cno1"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1 ">
                                <button class="btn btn-block btn-light" style="background-color:#808080; color: #FFF;">Confirm order details to review grand total ></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
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
                        <?php
                            if(isset($_SESSION["cart"])){
                                $arrLen = count($_SESSION["cart"]);
                                for($x=0; $x<$arrLen ; $x++){
                                    $cartResult = $menuObj ->getCartItems($_SESSION["cart"][$x]);
                                    $cartrow = $cartResult->fetch_assoc();
                                    
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $cartrow["item_name"];?>
                                    <br/>
                                    Portion Size:
                                    <?php
                                        $item_id = $cartrow["item_id"];
                                        $size = $cartrow["portion_size"];
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
                                    <?php if(!empty($cartrow["chicken_addon"])){?>
                                            Chicken Add-On's: Rs.<?php echo $cartrow["chicken_addon"];}
                                            if(!empty($cartrow["egg_addon"])){?><br>
                                            Egg Add-On's: Rs.<?php echo $cartrow["egg_addon"];}
                                    ?>
                                    <br/>
                                    <?php if(!empty($cartrow["remarks"])){?>
                                    Special Remarks: <?php echo $cartrow["remarks"];}?>
                                </td>
                        
                                <td>Rs.<?php echo number_format($cartrow["unit_price"]);?></td>
                                <td><?php echo $cartrow["quantity"];?></td>
                                <td>Rs.<?php echo number_format($cartrow["sub_total"]);?> </td>
                                
                            </tr>
                        <?php
                            }
                            }
                        ?> 
                            <tr>            
                                <td></td>
                                <td></td>
                                <td><strong>Sub-Total</strong></td>
                                <td id="sub_total">Rs.
                                    <?php
                                    $sub_total =0;
                                    if(isset($_SESSION["cart"])){
                                        $arrLen = count($_SESSION["cart"]);
                                        for($x=0; $x<$arrLen ; $x++){
                                            $subTotalResult = $menuObj ->getsub_total($_SESSION["cart"][$x]);
                                            while($subTotalRow = $subTotalResult->fetch_assoc()){
                                                $sub_total += $subTotalRow["sub_total"];
                                            }
                                        }
                                    }
                                    echo number_format($sub_total);
                                    ?>
                                </td>
                            </tr>
                            <tr>            
                                <td></td>
                                <td></td>
                                <td><strong>Delivery charges</strong></td>
                                <td id="deliverycharges">Rs.0</td>
                            </tr>
                            <tr>            
                                <td></td>
                                <td></td>
                                <td><strong>Grand Total</strong></td>
                                <td id="grand_total">Rs.
                                    <?php
                                    echo number_format($sub_total);  
                                    ?>
                                    
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <div class="row" id="paymentButton" style="display: none;">
                    <div class="col-md-5 col-md-offset-8">
                        <a href="../view/my_payment.php">
                        <button class="btn btn-block btn-light" style="background-color:#808080; color: #FFF;">Proceed to Payment ></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_checkout_validation.js" type="text/javascript"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>