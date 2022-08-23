
<?php
    include '../commons/my_session.php';
    include '../model/my_module_model.php';
    $moduleObj = new my_module_model();
    $moduleResult = $moduleObj-> getAllModules($_SESSION["user"]["role_id"]);
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
                    <?php
                        while($module_row = $moduleResult->fetch_assoc())
                        {
                    ?>
                        <a href=" <?php echo $module_row["url"]; ?>">
                            <div class="col-md-offset-1 col-md-2 panel" style="background-color: #C0C0C0; height: 150px;">
                        <h5 align="center" class="h4" style="color: #808080;"><?php echo $module_row["module_name"]; ?></h5>
                                <img src="../images/iconset/<?php echo $module_row["module_image"]; ?>" width="80px" height="100px" style="margin-left: 50px;"/>
                            </div>
                        </a>
                    <?php
                        }
                    ?>    
                    &nbsp;
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                      
                    &nbsp;
                </div>
            </div>               
        </div>                            
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_loginvalidations.js" type="text/javascript"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
    
</html>                                  
                                
                            
                        
                        
                    
            
        
        
            
     
