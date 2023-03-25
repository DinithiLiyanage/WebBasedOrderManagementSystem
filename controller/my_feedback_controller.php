<?php
include '../commons/my_session.php';

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_customer_feedback.php"</script>
    <?php
}
include'../model/my_feedback_model.php';
$feedbackObj = new my_feedback_model();
$status = $_GET["status"];
switch($status)
{
    case "addFeedback":
    $rate = $_POST["rate"];
    $satisfaction = $_POST["satisfied"];
    $prices = $_POST["prices"];
    $timeliness = $_POST["timeliness"];  
    $support = $_POST["support"];
    $recommend = $_POST["recommend"];
    $suggestions = $_POST["suggestions"];  
    
    try{
        if($rate == "" || $satisfaction == "" || $prices == "" || $timeliness == "" || $support == "" || $recommend == "")
        {
            throw new Exception("Fields marked with an asterix can't be empty");
        }
        
        $feedback_id = $feedbackObj ->addFeedback($rate, $satisfaction, $prices, $timeliness, $support, $recommend, $suggestions);
    
        ?>
        <script> window.location = '../view/my_dashboard.php'</script>
        <?php
    } catch (Exception $ex) {
        $msg= $ex->getMessage();
        $msg= base64_encode($msg);
            
            ?>
                <Script> window.location= "../view/my_customer_feedback.php?msg=<?php echo $msg; ?>" </script> 
            <?php

    }

    
        
    break;
    
default:
        ?>
        <script>window.location="../view/my_dashboard.php"</script>
        <?php
        break;

}



