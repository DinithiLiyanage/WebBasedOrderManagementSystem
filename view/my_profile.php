<?php
    include '../commons/my_session.php';
    include '../model/my_user_model.php';
    $userObj = new my_user_model();
    $detailResult = $userObj ->getUserDetails($_SESSION["user"]["user_id"]);
    $detailRow = $detailResult ->fetch_assoc();
?> 

<html>
    <head>
        <?php
        include '../includes/my_css_includes.php';
        ?>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
        <style>
                /* Style the tab */
        .tab {
          overflow: hidden;
          border: 1px solid #ccc;
          background-color: #C0C0C0;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
          background-color: inherit;
          float: left;
          border: none;
          outline: none;
          cursor: pointer;
          padding: 14px 16px;
          transition: 0.3s;
          color: #FFFFFF;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
          background-color: #F5F5F5;
          color: black;
        }

        /* Create an active/current tablink class */
        .tab button.active {
          background-color: #808080;
          color: white;
        }

        /* Style the tab content */
        .tabcontent {
          display: none;
          padding: 20px 20px;
          border: 1px solid #ccc;
          border-top: none;
          height: 100%;
        }
        
        </style>
        
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
            <div class="tab">
                <button class="tablinks" onclick="openItem(event, 'My details')" id="defaultOpen">My Details</button>
                <button class="tablinks" onclick="openItem(event, 'My password')" >My Password</button>
                <?php
                if($_SESSION["user"]["role_id"]== 1){ ?>
                    <button class="tablinks" onclick="openItem(event, 'My orders')" >My Orders</button>
                    <button class="tablinks" onclick="openItem(event, 'My payments')" >My Payments</button>
                <?php
                }
                ?>
            </div>
        
            <div id="My details" class="tabcontent">
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="h4" style="color: black;">Personal Information</h4>
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
                                <form action="../controller/my_profile_controller.php?status=editprofile" method="post">
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
                                            <label class="control-label">Contact Number:</label>
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
                                            <label class="control-label">Contact Number:</label>
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
                                            <label class="control-label">Address:</label>
                                        </div> 
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $detailRow["user_address"]; ?>" >
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
                                        <div class="col-md-3 col-md-offset-7">
                                            <button class="btn btn-block" id="changedetails" style="background-color:#808080; color:#FFFFFF;">Edit Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            
            <div id="My password" class="tabcontent">
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4 class="h4" style="color: black;">Change Your Password</h4>
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
                                <form action="../controller/my_profile_controller.php?status=changepassword" method="post">
                                <div class="row">
                                    <div class="col-md-offset-1">
                                        <label class="control-label">Current Password</label>
                                        <div class="input-group" style="width: 80%;">
                                            <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Please enter your current password" >
                                            <span class="input-group-addon">
                                                <i class=" fa fa-eye-slash" id="currenttoggle" style="cursor: pointer; margin-left: -3px; z-index: 100;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-1 ">
                                        <label class="control-label">New Password</label>
                                        <div class="input-group" style="width: 80%;" >
                                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Please enter the new password" >
                                            <span class="input-group-addon">
                                                <i class="fa fa-eye-slash" id="newtoggle" style="cursor: pointer; margin-left: -3px; z-index: 100;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-1">
                                        <label class="control-label">Confirm Password</label>
                                        <div class="input-group" style="width: 80%;" >
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Please confirm your new password" >
                                            <span class="input-group-addon">
                                                <i class="fa fa-eye-slash" id="confirmtoggle" style="cursor: pointer; margin-left: -3px; z-index: 100;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-7">
                                        <button class="btn btn-block" id="changepassword" style="background-color:#808080; color:#FFFFFF;">Change Password</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <?php
            if($_SESSION["user"]["role_id"]== 1){ ?>
                <div id="My orders" class="tabcontent">
                    <h3>Tokyo</h3>
                    <p>Tokyo is the capital of Japan.</p>
                </div>
                <div id="My payments" class="tabcontent">
                    <h3>Tokyo</h3>
                    <p>Tokyo is the capital of Japan.</p>
                </div>
            <?php
            }
            ?>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_profile_validations.js" type="text/javascript"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>
