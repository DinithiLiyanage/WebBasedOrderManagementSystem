<?php

    include '../commons/my_session.php';
    include'../model/my_login_model.php';
    include_once'../model/my_menu_model.php';
    $loginObj = new my_login_model();
    $menuObj = new my_menu_model();
    $loginResult = $loginObj ->UserLogout($_SESSION["user"]["email"]);
    $cartStatus = $menuObj ->deletecart($user_id);
    session_destroy();
    header("location: ../view/my_user_login.php");

?>

