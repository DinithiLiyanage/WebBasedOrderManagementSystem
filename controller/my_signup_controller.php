<?php
include '../commons/my_session.php';

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_user_signup.php"</script>
    <?php
}

include_once'../model/my_signup_model.php';

$signupObj  = new my_signup_model();

$status = $_GET["status"];
switch($status)
{
    
    case "signup":
        $fname = $_POST["firstname"];
        $lname = $_POST["lastname"];
        $email = $_POST["username"];
        $cno1 = $_POST["cno1"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $role_id = 1;
        
        
        try{
            if ($fname=="")
            {
                throw new Exception("First name can't be empty");
            }
            if ($lname=="")
            {
                throw new Exception("Last name can't be empty");
            }
            if ($email=="")
            {
                throw new Exception("Email can't be empty");
            }
            if ($password=="")
            {
                throw new Exception("Password can't be empty");
            }
            if ($password!= $confirmPassword)
            {
                throw new Exception("Passwords do not match");
            }
            
            
            
            $patcno = "/^\+94[0-9]{9}$/";
            $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";
            
            if(!preg_match($patemail, $email))
            {
                throw new Exception("Email is invalid");
            }
            
            if(!preg_match($patcno, $cno1))
            {
                throw new Exception("Contact Number is invalid");
            }
            
            
            $addUserResult = $signupObj->addUser($fname, $lname, $email, $cno1, $role_id);
            
            $pwrd = sha1($password);
            $addLoginResult = $signupObj->addLogin($email, $pwrd);
            ?>
                <Script> window.location= "../view/my_dashboard.php" </script> 
            <?php
            
        
            
            
        } catch (Exception $ex){
         
        $msg= $ex->getMessage();
        $msg= base64_encode($msg);
        
        ?>
            <Script> window.location= "../view/my_user_signup.php?msg=<?php echo $msg; ?>" </script> 
        <?php
        }
        
        break;
    default:
        ?>
    <script>window.location="../view/my_user_login.php"</script>
        <?php
    break;

}





