<?php
include '../commons/my_session.php';
include '../model/my_user_model.php';
$userObj = new my_user_model();
$getUserResult = $userObj ->getAllUsers();


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
                    <table class="table " id="usertable">
                        <thead>
                            <tr>
                                <th>User First Name</th>
                                <th>User Last Name</th>
                                <th>User Email</th>
                                <th>User Role</th>
                                <th>Login Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($userrow = $getUserResult->fetch_assoc())
                                {
                                    
                            ?>
                            <tr>
                                <td><?php echo $userrow["user_fname"];?></td>
                                <td><?php echo $userrow["user_lname"];?></td>
                                <td><?php echo $userrow["user_email"];?></td>
                                <td><?php echo $userrow["role_name"];?></td>
                                <td <?php if($userrow["login_status"]==1){?> class="success" <?php } ?> >
                                    <?php
                                    if($userrow["login_status"]==1)
                                    {
                                    ?>
                                    Active
                                    <?php
                                    }
                                    else{
                                        ?>
                                        De Active
                                        <?php
                                    }
                                    ?>
                                </td>
                            
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="my_generate_user_report.php" class="btn btn-success">
                                Generate User Report
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
                          
        </div>                            
    </body>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    
    <!-- include bootstrap js -->
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    
    <script src="../js/datatable/jquery-3.5.1.js"></script>
    
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $document.ready(function(){
            $(#usertable).DataTable();
        });
    </script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    
</html>