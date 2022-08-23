<?php
    include '../commons/my_session.php';
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
            <div class="col-md-12">
                <h3 class="h3"> SHOPPING CART</h3>
                    <table class="table " id="usertable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Item Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><a href="../controller/my_cart_controller.php?clear=all" id="clearAll" class="btn btn-danger">Empty Cart</a></th>
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
                                <td><img src="../images/menu/<?php echo $cartrow["item_image"]; ?>" width="50px" height='50px' style="margin-left: 50px;"></td>
                                <td><?php echo $cartrow["item_name"];?>
                                    <a href="../view/my_menu_item.php?msg=<?php echo $cartrow["item_id"];?>">
                                        <button type="button"  class="btn btn-default btn-sm" style="float: right;">
                                            Edit  
                                        </button></a>
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
                                <td><a href="../controller/my_cart_controller.php?remove=<?php echo $cartrow["cart_id"];?>" 
                                       class="removeItem" >
                                        <button type="button"  class="btn btn-default btn-sm" style="text-align: center;">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button></a></td>
                            </tr>
                        <?php
                            }
                            }
                        ?> 
                            <tr>            
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Sub-Total</strong></td>
                                <td>Rs.
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
                                <td></td>
                                <td></td>
                                <td><strong>Grand Total</strong></td>
                                <td>Rs.
                                    <?php
                                    echo number_format($sub_total);
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <a href="../view/my_dashboard.php">
                                <button class="btn btn-block btn-light" style="background-color: #C0C0C0; color: #FFF;">< Continue Shopping</button></a>
                        </div>
                        <div class="col-md-6">
                            <a href="../view/my_checkout.php">
                                <button class="btn btn-block btn-light" style="background-color:#808080; color: #FFF;">Proceed to Checkout ></button></a>
                        </div>
                    </div>
                </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_cart_validation.js" type="text/javascript"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>
