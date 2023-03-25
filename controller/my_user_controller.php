<?php
include '../commons/my_session.php';

if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_user_login.php"</script>
    <?php
}
include'../model/my_login_model.php';
include_once'../model/my_user_model.php';
$loginObj = new my_login_model();
$userObj  = new my_user_model();

$status = $_GET["status"];
switch($status)
{
    case "add_user":
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        $dob = $_POST["dob"];
        $nic = $_POST["nic"];
        $role_id = $_POST["role_id"];
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

                $patnic = "/^[0-9]{9}[vVxX]$/";
                $patcno = "/^\+94[0-9]{9}$/";
                $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";

                if(!preg_match($patemail, $email))
                {
                    throw new Exception("Email is invalid");
                }
                if(!preg_match($patnic, $nic))
                {
                    throw new Exception("NIC is invalid");
                }
                if(!preg_match($patcno, $cno1))
                {
                    throw new Exception("Contact Number 1 is invalid");
                }
                if(!preg_match($patcno, $cno2))
                {
                    throw new Exception("Contact Number 2 is invalid");
                }

                $userId = $userObj->addUser($fname, $lname, $email, $nic, $dob, $cno1, $cno2, $role_id);
                $loginId = $userObj ->addUserLogin($email);

                if($userId >0 AND $loginId >0)
                {
                ?>
                    <Script> window.location= "../view/my_dashboard.php" </script> 
                <?php
                }
        }catch (Exception $ex){
            $msg= $ex->getMessage();
            $msg= base64_encode($msg);
        ///when u enter wrong credentials, u will be redirected to the login pg and an
        ///error msg is seen in the URL. This is decoded in the login pg.
            ?>
                <Script> window.location= "../view/my_add_user.php?msg=<?php echo $msg; ?>" </script> 
            <?php
        
            
        }
        
        break;
    case "changeUserDetails":
        $userId = $_POST["user_id"];
        $fname = $_POST["firstname"];
        $lname = $_POST["lastname"];
        $email = $_POST["username"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        $dob = $_POST["dob"];
        $nic = $_POST["nic"];
        $role = $_POST["user_role"];
        
        
            $profileResult = $userObj->changeUserDetails($user_id, $fname, $lname, $email, $dob, $cno1, $cno2, $nic, $role );
            
            ?>
                <Script> window.location= "../view/my_view_details.php" </script> 
            <?php
        break;
        
    default:
        ?>
    <script>"../view/my_user_login.php"</script>
        <?php
    break;

}
if(isset($_GET["remove"])){
    $user_id = $_GET["remove"];
    $deleteUserResult = $userObj ->deleteUserRecord($user_id);
    $arrlen = count($_SESSION["cart"]);
    
    ?>
    <script>window.location="../view/my_view_details.php"</script>
    <?php
}

        
            


