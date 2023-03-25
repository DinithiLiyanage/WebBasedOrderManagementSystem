
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
                    <form action="../controller/my_menu_controller.php?status=changedescript" method="post">
                        <input type="hidden" class="item_id" id="item_id" name="item_id" value="<?php echo $item_row["item_id"]; ?>">
                        <label class="control-label">Item Name: </label>
                        <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_row["item_name"]; ?>">
                    
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <label class="control-label">Small Portion price: </label>
                        <input type="number" class="form-control" id="small_price" name="samll_price" value="<?php echo $item_row["small_price"]; ?>">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <label class="control-label">Regular Portion price: </label>
                        <input type="number" class="form-control" id="regular_price" name="regular_price" value="<?php echo $item_row["regular_price"]; ?>">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <?php if(!empty($item_row["chicken_addon"]) or !empty($item_row["egg_addon"])){
                            if(!empty($item_row["chicken_addon"])){?>
                        
                        <label class="control-label">Extra chicken add on price: </label>
                        <input type="number" class="form-control" id="chicken_addon" name="chicken_addon" value="<?php echo $item_row["chicken_addon"]; ?>">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <?php
                            }
                            if(!empty($item_row["egg_addon"])){?>
                        <label class="control-label">Extra egg add on price: </label>
                        <input type="number" class="form-control" id="egg_addon" name="egg_addon" value="<?php echo $item_row["egg_addon"]; ?>">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                        
                        <br/>
                        <h4><label for='item_descripiton' class="control-label" style='font-weight: normal;'>Item description</label></h4>
                        <textarea name='item_description'  class="form-control" id="item_description" cols='80' rows='2' placeholder="Add item description"></textarea>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-1">
                                <button type="submit" class="btn btn-block" id="ChangeDescript" style="background-color:#808080; color:#FFFFFF;">Change Item Description</button>
                            </div>
                            <div class="col-md-3 ">
                                <a href="../controller/my_menu_controller.php?remove=<?php $item_row["item_id"]; ?>">
                                    <button type="button" class="btn btn-block" id="removeItem" style="float: right; background-color: red; color:#FFFFFF;">Remove Item</button>
                                </a>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
                
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>
<?php
    }
?>
                                
                                    


