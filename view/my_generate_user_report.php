<?php

include '../commons/fpdf181/fpdf.php'; //include the library
include '../model/my_user_model.php';
$userObj = new my_user_model();
$userResult = $userObj-> getAllUsers();
    
//create a pdf
$fpdf = new FPDF;
$fpdf-> SetTitle("Staff Report"); 
$fpdf->AddPage("P","A4",0);
$fpdf->SetFont("Arial","B","16");
$fpdf->Image("../images/Logo.png", 10, 15, 30, 10);

$fpdf->Cell(0, 20, "User Report", 0, 1, "C");

$fpdf->SetFont("Arial","B","12");
$fpdf->Cell(35, 10, "First Name", 1, 0, "C");
$fpdf->Cell(35, 10, "Last Name", 1, 0, "C");
$fpdf->Cell(50, 10, "Email", 1, 0, "C");
$fpdf->Cell(40, 10, "Role", 1, 0, "C");
$fpdf->Cell(30, 10, "Status", 1, 1, "C");

while($userrow=$userResult->fetch_assoc())
{
    $fpdf->SetFont("Arial","","10");
    $fpdf->Cell(35, 10,$userrow["user_fname"] , 1, 0, "C");
    $fpdf->Cell(35, 10,$userrow["user_lname"] , 1, 0, "C");
    $fpdf->Cell(50, 10,$userrow["user_email"] , 1, 0, "C");
    $fpdf->Cell(40, 10,$userrow["role_name"] , 1, 0, "C");
    
    if(($userrow["user_status"])==1)
    {
        $status="Active";
    }
    else{
        $status="DeActive";
    }
    $fpdf->Cell(30, 10, $status, 1, 1, "C");
}


$fpdf->Output();



