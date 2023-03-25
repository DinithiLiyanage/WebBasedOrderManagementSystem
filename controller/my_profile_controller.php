<?php
include '../commons/my_session.php';

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_profile.php"</script>
    <?php
}

include_once'../model/my_user_model.php';

$userObj  = new my_user_model();

$status = $_GET["status"];
switch($status)
{
    
    case "changepassword":
        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];
        $user_id = $_SESSION["user"]["user_id"];
        
        
        try{
            
            if ($current_password=="")
            {
                throw new Exception("Password can't be empty");
            }
            if ($new_password=="")
            {
                throw new Exception("Password can't be empty");
            }
            $patpwrd = "/([a-z]+[A-Z]+[0-9]){8}/";
            
            if(!preg_match('/[a-z]/', $new_password) || !preg_match('/[A-Z]/', $new_password) || !preg_match('/[0-9]/', $new_password))
            {
                throw new Exception("Password should contain atleast one lowercase, one uppercase and a number");
            }
            if (strlen($new_password)<8)
            {
                throw new Exception("Password should contain atleast 8 characters");
            }
            if ($confirm_password=="")
            {
                throw new Exception("Password can't be empty");
            }
            if ($new_password!= $confirm_password)
            {
                throw new Exception("Passwords do not match");
            }
            $oldPassword = sha1($current_password);
            $oldPwrdResult = $userObj->getPassword($user_id);
            $oldPwrdRow = $oldPwrdResult ->fetch_assoc();
            if ($oldPassword != $oldPwrdRow["user_password"] )
            {
                throw new Exception("Old password doesn't match");
            }
            
            $pwrd = sha1($new_password);
            $changePwrdResult = $userObj->changePassword($user_id, $pwrd);
            ?>
                <Script> window.location= "../view/my_profile.php" </script> 
            <?php
            
        
            
            
        } catch (Exception $ex){
         
        $msg= $ex->getMessage();
        $msg= base64_encode($msg);
        
        ?>
            <Script> window.location= "../view/my_profile.php?msg=<?php echo $msg; ?>" </script> 
        <?php
        }
        
        break;
        
        case "editprofile":
        $fname = $_POST["firstname"];
        $lname = $_POST["lastname"];
        $email = $_POST["username"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        $address = $_POST["address"];
        $nic = $_POST["nic"];
        $user_id = $_SESSION["user"]["user_id"];
        
        try{
            $patnic = "/^[0-9]{9}[vVxX]$/";
            $patcno = "/^\+94[0-9]{9}$/";
            $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";
            
            if($email != "")
            {    
                if(!preg_match($patemail, $email))
                {
                    throw new Exception("Email is invalid");
                }
            }
            if($nic != "")
            {
                if(!preg_match($patnic, $nic))
                {
                    throw new Exception("NIC is invalid");
                }
            }
            if($cno1 != "")
            {
                if(!preg_match($patcno, $cno1))
                {
                    throw new Exception("Contact Number is invalid");
                }
            }
            if($cno2 != "")
            {
                if(!preg_match($patcno, $cno2))
                {
                    throw new Exception("Contact Number is invalid");
                }
            }
            
            $profileResult = $userObj->changeProfile($user_id, $fname, $lname, $email, $address, $cno1, $cno2,$nic );
            $loginEditResult = $userObj->changeLogin($user_id, $email);
            
            ?>
                <Script> window.location= "../view/my_profile.php" </script> 
            <?php
            
        
            
            
        } catch (Exception $ex){
         
        $msg= $ex->getMessage();
        $msg= base64_encode($msg);
        
        ?>
            <Script> window.location= "../view/my_profile.php?msg=<?php echo $msg; ?>" </script> 
        <?php
        }
        
        break;
    default:
        ?>
    <script>window.location="../view/my_dashboard.php"</script>
        <?php
    break;

}







