<?php

include '../commons/fpdf181/fpdf.php'; //include the library
include '../model/my_order_model.php';
$orderObj = new my_order_model();
$getPaymentResults = $orderObj ->getFinishedOrders();
    
//create a pdf
$fpdf = new FPDF;
$fpdf-> SetTitle("Order Report"); //title of the doc
$fpdf->AddPage("P","A4",0);
$fpdf->SetFont("Arial","B","16");
$fpdf->Image("../images/Logo.png", 10, 15, 30, 10);

$fpdf->Cell(0, 20, "Invoice Report", 0, 1, "C");

$fpdf->SetFont("Arial","B","12");
$fpdf->Cell(30, 10, "Order ID", 1, 0, "C");
$fpdf->Cell(50, 10, "Payment Date", 1, 0, "C");
$fpdf->Cell(40, 10, "Pickup Method", 1, 0, "C");
$fpdf->Cell(30, 10, "User Name", 1, 0, "C");
$fpdf->Cell(30, 10, "Amount", 1, 1, "C");


while($getPaymentRow = $getPaymentResults->fetch_assoc())
{
    $itemResult = $orderObj ->getOrderItems($getPaymentRow["order_id"]);
    
    $fpdf->SetFont("Arial","","10");
    $fpdf->Cell(30, 10,$getPaymentRow["order_id"] , 1, 0, "C");
    $fpdf->Cell(50, 10,$getPaymentRow["payment_date"] , 1, 0, "C");
    $fpdf->Cell(40, 10,$getPaymentRow["pick_method"] , 1, 0, "C");
    $fpdf->Cell(30, 10,$getPaymentRow["fname"]." ". $getPaymentRow["lname"], 1, 0, "C");
    $fpdf->Cell(30, 10,number_format($getPaymentRow["grand_total"]), 1, 1, "C");
    
}


$fpdf->Output();






