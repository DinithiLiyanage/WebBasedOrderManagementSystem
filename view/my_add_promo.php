
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
                    <h4 class="h4" style="color: black">Add New Promotional Offer</h4>
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
                <form action="../controller/my_menu_controller.php?status=addnewpromo" method="post">
                <div class="col-md-6" >
                    <label for="promo_image" class="control-label">Image for the promotional offer: </label>
                    <input type="file" class="form-control" id="promo_image" name="promo_image" style="width:500px; height:400px;">
                </div>
                <div class="col-md-6" >
                        <label class="control-label">Promotion Heading: </label>
                        <input type="text" class="form-control" id="promo_heading" name="promo_heading" placeholder="Heading for the promotion">
                    
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                       
                        <label for='promo_description' class="control-label">More about Promotional Offer: </label>
                        <textarea name='promo_description'  class="form-control" id="promo_description" cols='80' rows='2' placeholder="Add more details about the promotion"></textarea>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit"class="btn btn-block" style="background-color:#808080; color:#FFFFFF;">Add New Promotional Offer</button>
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


                                
                                    





