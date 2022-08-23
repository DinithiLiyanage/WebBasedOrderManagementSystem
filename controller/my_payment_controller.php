<?php
include '../commons/my_session.php';

include '../model/my_order_model.php';
$orderObj = new my_order_model();

if($_SESSION["user"]["role_id"] == 1){
    if(!isset($_GET["status"]))
    {
        ?>
        <script>window.location="../view/my_payment.php"</script>
        <?php

    }

    $status = $_GET["status"];
    switch($status)
    {
        case "makepayment":
            $date = $_POST["date"];
            $paymentMethod = $_POST["card_type"];
            $order_id = $_SESSION["order"];
            try{
                if($paymentMethod=="")
                {
                    throw new Exception("Please select payment method");
                }

                $payResult = $orderObj ->insertPaymentMethod($order_id, $date, $paymentMethod);
                ?>
                <script> window.location = '../view/my_payment_confirmation.php'</script>
                <?php

            } catch (Exception $ex) {
                {
                    $msg= $ex->getMessage();
                    $msg= base64_encode($msg);
                    ///when u enter wrong credentials, u will be redirected to the login pg and an
                    ///error msg is seen in the URL. This is decoded in the login pg.
                ?>
                    <Script> window.location= "../view/my_payment.php?msg=<?php echo $msg; ?>" </script> 
                <?php


                }
            }


            break;
        case "paymentdetails":
            $card_no = $_POST["card_no"];
            $month = $_POST["month"];
            $year = $_POST["year"];
            $pin = $_POST["pin_no"];
            $cardholder_name = $_POST["cardholder_name"];
            try{
                if($card_no=="")
                {
                    throw new Exception("Please enter card number");
                }

                if($month=="")
                {
                    throw new Exception("Please enter month of expiry");
                }

                if($year=="")
                {
                    throw new Exception("Please enter year of expiry");
                }

                if($pin_no=="")
                {
                    throw new Exception("Please enter PIN number");
                }

                if($cardholder_name=="")
                {
                    throw new Exception("Please enter cardholder name");
                }
                ?>
                <script> window.location = '../view/my_dashboard.php'</script>
                <?php



            } catch (Exception $ex) {
                {
                    $msg= $ex->getMessage();
                    $msg= base64_encode($msg);
                    ///when u enter wrong credentials, u will be redirected to the login pg and an
                    ///error msg is seen in the URL. This is decoded in the login pg.
                ?>
                    <Script> window.location= "../view/my_payment_confirmation.php?msg=<?php echo $msg; ?>" </script> 
                <?php


                }
            }


            break;

        

    }
}

elseif(isset($_GET["approveorder"])){
    
    $order_id = $_GET["approveorder"];
    $approveResult = $orderObj ->approveOrder($order_id);
    ?>
    <script>window.location="../view/my_accountant_payments.php"</script>
    <?php
}

