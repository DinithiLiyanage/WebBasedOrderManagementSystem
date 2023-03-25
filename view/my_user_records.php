<?php
    include '../commons/my_session.php';
    include '../model/my_user_model.php';
    $user_Obj = new my_user_model();
    $roleResult = $user_Obj-> getUserRoles();
    if(isset($_GET["msg"]))
    {
        $user_id = $_GET["msg"]; 
        $userResult = $user_Obj ->getUserRecord($user_id);
        $detailRow = $userResult->fetch_assoc();
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
                <div class="col-md-3">
                    <?php
                        include '../includes/my_user_sidebar.php';
                    ?>
                </div>
                <div class="col-md-9">
                    <form action="../controller/my_user_controller.php?status=changeUserDetails" action="post">
                        <input type="hidden" class="user_id"    id="user_id"    name="user_id"    value="<?php echo $user_row["user_id"]; ?>">
                        
                        <div class="row">
                            <div class="col-md-5">
                                <label class="control-label">First Name:</label>
                            </div> 
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $detailRow["user_fname"]; ?>" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 ">
                                <label class="control-label">Last Name:</label>
                            </div> 
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $detailRow["user_lname"]; ?>" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>            

                        <div class="row">
                            <div class="col-md-5 ">
                                <label class="control-label">Contact Number 1:</label>
                            </div> 
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="cno1" id="cno1" value="<?php echo $detailRow["user_cno1"]; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 ">
                                <label class="control-label">Contact Number 2:</label>
                            </div> 
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="cno2" id="cno2" value="<?php echo $detailRow["user_cno2"]; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 ">
                                <label class="control-label">Email:</label>
                            </div> 
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $detailRow["user_email"]; ?>" >
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-5 ">
                                <label class="control-label">Date of Birth:</label>
                            </div> 
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="dob" id="address" value="<?php echo $detailRow["user_dob"]; ?>" >
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                                    
                        <div class="row">
                            <div class="col-md-5 ">
                                <label class="control-label">NIC:</label>
                            </div> 
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="nic" id="nic" value="<?php echo $detailRow["user_nic"]; ?>" >
                            </div>
                        </div>
                                    
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-5 ">
                                <label class="control-label">User Role:</label>
                            </div> 
                            <div class="col-md-5">
                                <select class="form-control" name="user_role" id="user_role" required="required">
                                    <option value="<?php echo $detailRow["role_id"]; ?>"><?php echo $detailRow["role_name"]; ?></option>
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
                            <div class="col-md-3 col-md-offset-3">
                                <button type="submit" class="btn btn-block" id="changedetails" style="background-color:#808080; color:#FFFFFF;">Edit Profile</button>
                            </div>
                            <div class="col-md-3 ">
                                <a href="../controller/my_user_controller.php?remove=<?php $detailRow["user_id"]; ?>">
                                    <button type="button" class="btn btn-block" id="removeUser" style="float: right; background-color: red; color:#FFFFFF;">Remove user</button>
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
                                
                                    
