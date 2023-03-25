<?php
include '../commons/my_session.php';
include '../model/my_user_model.php';
$userObj = new my_user_model();
$activeUserResult = $userObj-> getActiveCustomers();
$activerow=$activeUserResult->fetch_assoc();
$activeUserCount =$activerow["Activecount"]; 
    
$deActiveUserResult = $userObj->getDeactiveCustomers();
$deactiverow=$deActiveUserResult->fetch_assoc();
$deActiveUserCount =$deactiverow["Deactivecount"];


?>


<html>
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawUserChart);
                
                function drawUserChart(){
                    var data = google.visualization.arrayToDataTable([
                            ['Status', 'Number of Users'],
                            ['Active',     <?php echo $activeUserCount;?>],
                            ['De-active',       <?php echo $deActiveUserCount;?>],
                    ]);
                var options = {
                    title: 'User Distribution By User Status',
                    colors: ['#808080','#C0C0C0']
                };
                var chart = new google.visualization.PieChart(document.getElementById('userchartdiv'));
                chart.draw(data, options);


                }
            </script>
        
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
                    <div class="col-md-4 panel" style="height: 200px;background-color: #808080">
                        <h3 class="h3" align="center" style="color: #FFF"> Active users </h3><!-- comment -->
                        <h1 class="h1" align="center" style="color: #FFF"><?php echo $activeUserCount; ?></h1>
                    </div>
                    <div class="col-md-4 col-md-offset-1 panel" style="height: 200px; background-color:#808080">
                        <h3 class="h3" align="center" style="color: #FFF"> De-active users </h3><!-- comment -->
                        <h1 class="h1" align="center" style="color: #FFF"><?php echo $deActiveUserCount; ?></h1>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="userchartdiv" style="height:300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>

