
<?php
    include '../commons/my_session.php';
    include '../model/my_menu_model.php';
    $menu_Obj = new my_menu_model();
    if(isset($_GET["msg"]))
    {
        $item_id = $_GET["msg"]; 
        $itemResult = $menu_Obj ->getItems($item_id);
        $item_row = $itemResult->fetch_assoc();
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
                <div class="col-md-12 alert-message" id="alert-message"></div>
            </div>
            
            
                            
            <div class="row" >
                
                <div class="col-md-6" >
                    <img src="../images/menu/<?php echo $item_row["item_image"]; ?>" width="500px" height='400px' style="margin-left: 50px;"/>
                </div>
                <div class="col-md-6" >
                    <h1 class="h1" style="text-transform: uppercase;"><?php echo $item_row["item_name"]; ?></h1>
                    
                    
                    <form action="../controller/my_menu_controller.php?status=additemtocart" action="post">
                        <input type="hidden" class="item_id"    id="item_id"    name="item_id"    value="<?php echo $item_row["item_id"]; ?>">
                        <input type="hidden" class="user_id"    id="user_id"    name="user_id"    value="<?php echo $_SESSION["user"]["user_id"]; ?>">
                        <input type="hidden" class="item_image" id="item_image" name="item_image" value="<?php echo $item_row["item_image"]; ?>">
                        <input type="hidden" class="item_name"  id="item_name"  name="item_name"  value="<?php echo $item_row["item_name"]; ?>">
                        
                        <label>Quantity</label>
                        <input type="number" class="quantity" id="quantity" name="quantity" value="1">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <h4 class="h4">Portion Size</h4>
                        <input type="radio" id="regular_size"  class="portion_size" name="portion_size" value="<?php echo $item_row["regular_price"]; ?>" checked>
                        <label for="regular_size">Regular Size (Rs.<?php echo $item_row["regular_price"]; ?>)</label><br>
                        <input type="radio" id="small_size" class="portion_size" name="portion_size" value="<?php echo $item_row["small_price"]; ?>">
                        <label for="small_size">Small Size  (Rs.<?php echo $item_row["small_price"]; ?>)</label><br>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <?php if(!empty($item_row["chicken_addon"]) or !empty($item_row["egg_addon"])){?>
                        <h4 class="h4">Add On's</h4>
                        <?php if(!empty($item_row["chicken_addon"])){?>
                        <input type="checkbox"  class="chicken_addon" id="chicken_addon" name="chicken_addon" value="<?php echo $item_row["chicken_addon"]; ?>">
                        <label for="chicken_addon">Extra chicken (+Rs.<?php echo $item_row["chicken_addon"]; ?>)</label><br>
                        <?php
                        }
                        if(!empty($item_row["egg_addon"])){?>
                        <input type="checkbox" class="egg_addon" id="egg_addon" name="egg_addon" value="<?php echo $item_row["egg_addon"]; ?>">
                        <label for="egg_addon">Extra egg  (+Rs.<?php echo $item_row["egg_addon"]; ?>)</label><br>
                        <?php
                        }
                        ?>
                        <?php
                        }
                        ?>
                        <br/>
                        <h4><label for='remarks' style='font-weight: normal;'>Any special remarks?</label></h4>
                        <textarea name='remarks'  class="remarks" id="remarks" cols='80' rows='2' placeholder="Type your instructions here"></textarea>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-block addItem" id="addItem" style="background-color:#808080; color:#FFFFFF;">Add to cart</button>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
                
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_add_to_cart_validations.js" ></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>
<?php
    }
?>
                                
                                    
