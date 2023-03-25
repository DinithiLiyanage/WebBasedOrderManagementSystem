
<?php
    include '../commons/my_session.php';
    include '../model/my_menu_model.php';
    $menu_Obj = new my_menu_model();
    $catResult = $menu_Obj ->getAllCat();
    
    
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
                    <h4 class="h4" style="color: black">Add New Item TO Menu</h4>
                    <div id="alertmsg"></div>
                    <?php
                    if(isset($_GET["msg"]))
                    {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo base64_decode($_REQUEST["msg"])?>
                    </div>    
                    <?php    
                    }
                    ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 alert-message" id="alert-message"></div>
            </div>
            
            
            <div class="row" >
                <form action="../controller/my_menu_controller.php?status=addnewitem" method="post">
                <div class="col-md-6" >
                    <label for="item_image" class="control-label">Item Image: </label>
                    <input type="file" class="form-control" id="item_image" name="item_image" style="width:500px; height:400px;">
                </div>
                <div class="col-md-6" >
                        <label class="control-label">Item Category: </label>
                        <select class="form-control" name="item_cat" id="item_cat" required="required">
                                <option placeholder="Item category">---</option>
                                <?php
                                    while($cat_row= $catResult->fetch_assoc())
                                    {
                                ?>
                                <option value=" <?php echo $cat_row["cat_id"]; ?>">
                                    <?php
                                        echo $cat_row["cat_name"];
                                    ?>
                                </option>
                                <?php
                                    }
                                ?>
                        </select>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                    
                        <label class="control-label">Item Name: </label>
                        <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Item Name">
                    
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <label class="control-label">Small Portion price: </label>
                        <input type="number" class="form-control" id="small_price" name="small_price" placeholder="Small portion price">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <label class="control-label">Regular Portion price: </label>
                        <input type="number" class="form-control" id="regular_price" name="regular_price" placeholder="Regular portion price">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <label class="control-label">Extra chicken add on price: </label>
                        <input type="number" class="form-control" id="chicken_addon" name="chicken_addon" placeholder="Chicken addon price">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <label class="control-label">Extra egg add on price: </label>
                        <input type="number" class="form-control" id="egg_addon" name="egg_addon" placeholder="Egg addon price">
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <label for='item_descripiton' class="control-label">Item description</label>
                        <textarea name='item_description'  class="form-control" id="item_description" name="item_description" cols='80' rows='2' placeholder="Add item description"></textarea>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit"class="btn btn-block" style="background-color:#808080; color:#FFFFFF;">Add New Item</button>
                            </div>
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


                                
                                    



