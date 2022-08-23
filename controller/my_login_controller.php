<?php
include '../commons/my_session.php';
/// if the login status is not given then the user is redirected to the login.php page
if(!isset($_GET["status"]))
{
    ?>
    <script>window.location="../view/my_user_login.php"</script>
    <?php
}
include'../model/my_login_model.php';
$loginObj = new my_login_model();
$status = $_GET["status"];
switch($status)
{
    case "login":
    try
    {
        $loginUsername=$_POST["username"];
        $loginPassword=$_POST["password"];
        
        if($loginUsername=="")
        {
            throw new Exception("Username cannot be empty");
        }
        if($loginPassword=="")
        {
            throw new Exception("Password cannot be empty");
        }
        
        $userResult = $loginObj->ValidateLogin($loginUsername, $loginPassword);
        
        if ($userResult->num_rows ===0){
            throw new Exception("Invalid credentials!!!");
        }
        
        $loginResult = $loginObj ->ChangeLoginStatus($loginUsername);
        $userRow = $userResult -> fetch_assoc();
        
       
        $userarray = array(
            "first_name"=>$userRow["user_fname"],
            "email"=>$userRow["user_email"],
            "user_id"=>$userRow["user_id"],
            "role_id"=>$userRow["role_id"]
            
        );
        $_SESSION["user"]= $userarray;
        
        
        ?>
        <script> window.location = '../view/my_dashboard.php'</script>
        <?php
        
    } catch (Exception $ex) 
    {
        $msg= $ex->getMessage();
        $msg= base64_encode($msg);
        ///when u enter wrong credentials, u will be redirected to the login pg and an
        ///error msg is seen in the URL. This is decoded in the login pg.
    ?>
        <Script> window.location= "../view/my_user_login.php?msg=<?php echo $msg; ?>" </script> 
    <?php
        

    }
        
        break;
    default:
        ?>
        <script>window.location="../view/my_user_login.php"</script>
        <?php
        break;

}



