<?php
    include '../model/my_user_model.php';
    $userObj = new my_user_model();
    $roleResult = $userObj-> getUserRoles();
    include '../commons/my_session.php';
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
                <div class="col-md-3">
                    <?php
                        include '../includes/my_user_sidebar.php';
                    ?> 
                </div>
                <div class="col-md-9">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="h4" style="color: black">Add New User Account</h4>
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
                    <form action="../controller/my_user_controller.php?status=add_user" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">First name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="fname" id="fname"/>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Last name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="lname"id="lname"/>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="email"id="email"/>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Date of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="dob" id="dob"/>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">NIC</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="nic" id="nic"/>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Contact No1</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cno1" id="cno1"/>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Contact No2</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cno2" id="cno2"/>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Role ID</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="role_id" id="role_id" required="required">
                                <option value="">---</option>
                                <?php
                                    while($role_row= $roleResult->fetch_assoc())
                                    {
                                ?>
                                <option value=" <?php echo $role_row["role_id"]; ?>">
                                    <?php
                                        echo $role_row["role_name"];
                                    ?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3" id="usercont">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-3">
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                            &nbsp;
                            <button type="reset" class="btn btn-danger">
                                Reset
                            </button>
                        </div>
                    </div>
                    </form>    
                </div>
                </div>
        </div>               
                                   
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_user_validation.js"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
    
</html>                                  
                                
                            
                        
                        
                    
            
        
        
            
     





