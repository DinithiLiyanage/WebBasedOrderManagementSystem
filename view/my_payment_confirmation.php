<?php
    include '../commons/my_session.php';
    include '../model/my_order_model.php';
    $orderObj = new my_order_model();
    $grandResult = $orderObj ->getgrand_total($_SESSION["order"]);
    $grandRow = $grandResult -> fetch_assoc();
    $grand_total = $grandRow["grand_total"];
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
                <div class="col-md-11 col-md-offset-0">
                    <div class="panel panel-default">
                        <form action="../controller/my_payment_controller.php?status=paymentdetails" method="post">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
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
                                <div class="col-md-5">
                                    <label class="control-label">Card Number:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="card_no" id="card_no" value=""/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label">Month of Expiry:</label>
                                </div>
                                <div class="col-md-3">
                                    <select id="month" name="month" class="form-control">
                                        <option value="">--</option>
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Year of Expiry:</label>
                                </div>
                                <div class="col-md-3">
                                    <select id="year" name="year" class="form-control">
                                        <option value="">----</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="control-label">PIN No:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="pin_no" id="pin_no" value=""/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="control-label">Name of cardholder:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="cardholder_name" id="cardholder_name" value=""/>
                                </div>
                            </div>
                        </div>
                        <hr  style="border: 1px solid;">
                        <div class="panel-heading">
                            <h4 class="h4" style="text-align: right;">Amount: LKR<?php echo number_format($grand_total); ?></h4>
                            <div class="row">
                                    <div class="col-md-2 col-md-offset-10">
                                        <button type="submit" class="btn btn-success btn-block">
                                        Pay
                                        </button>
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>

