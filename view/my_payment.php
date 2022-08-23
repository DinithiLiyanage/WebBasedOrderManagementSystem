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
            
            <div class="col-md-8">
                <div class="col-md-11 col-md-offset-0">
                    <div class="panel panel-default">
                        <div class="panel-body" >
                                <h5 class="h5">PAYMENT AMOUNT</h5>
                                <h3 class="h3">LKR <?php echo number_format($grand_total); ?></h3>
                                <hr  style="border: 1px solid;">
                                
                        </div>
                            
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
                            <form action="../controller/my_payment_controller.php?status=makepayment" method="post">
                                <input type="hidden" id="date" name="date" value="<?php echo date('d-m-y h:i:s'); ?>"/>
                                <h4 class="h4">Select payment method</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="radio" id="visa"   name="card_type" value="Visa">
                                        <label for="card_type">
                                            <img src="../images/card/visa-card.png" width="50px" height='40px' style="margin-left: 10px;"> Visa </label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" id="master"   name="card_type" value="Mastercard">
                                        <label for="card_type">
                                            <img src="../images/card/master.jpg" width="50px" height='40px' style="margin-left: 10px;"> Mastercard</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="radio" id="visa"   name="card_type" value="AmericanExp">
                                        <label for="card_type">
                                            <img src="../images/card/american.png" width="50px" height='40px' style="margin-left: 10px;"> American Express</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <button type="submit" class="btn btn-success btn-block">
                                        LKR <?php echo number_format($grand_total); ?>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="col-md-12 col-md-offset-0">
                    <div class="panel panel-default" style="height: 350px;box-shadow: 3px 5px 3px #888888">
                        <div class="panel-heading">
                            <h3 style="font-family: Papyrus; font-weight: bold; font-size: 35px; text-align: center; ">Food Before Me</h3>
                            <h5 class="h4">Invoice</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p class="title" style="float: left; width: 50%;"> Invoice No</p>
                                    <p class="data"  style="float: right; width: 50%;text-align: right;"><?php echo $_SESSION["order"];?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p class="title" style="float: left; width: 50%;">Date </p>
                                    <p class="data"  style="float: right; width: 50%;text-align: right;">
                                        <?php
                                        $date = date('d-m-y h:i:s');
                                        echo $date;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p class="title" style="float: left; width: 50%;"> Payment amount</p>
                                    <p class="data"  style="float: right; width: 50%;text-align: right;">LKR <?php echo number_format($grand_total);?></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/my_logout.js" type="text/javascript"></script>
    <script src="../bootstrap/css/bootstrap.min.js" type="text/javascript"></script>
</html>


