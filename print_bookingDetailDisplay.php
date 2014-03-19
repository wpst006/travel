<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/bookingHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        
        $this->Cell(50, 7, 'Package', 1);
        $this->Cell(50, 7, 'Duration', 1);
        $this->Cell(50, 7, 'No of People', 1);
        $this->Cell(50, 7, 'Price', 1);

        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(50,7, $row['package_title'], 1);
            $this->Cell(50, 7, $row['duration'], 1);
            $this->Cell(50, 7, $row['no_of_people'], 1);  
            $this->Cell(50, 7, $row['price'], 1);
                      
            $this->Ln();
        }
    }

}

//***************************************************************************************************************
$booking_id = $_GET['booking_id'];
$bookingData = bookingHelper::getBookingByBookingID($booking_id);
$bookingDetailData = bookingHelper::getBookingDetailsByBookingID($booking_id);
//***************************************************************************************************************
// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Bookings Report', 0, 1, 'C');

$pdf->Ln();

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Booking ID :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['booking_id'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Booking Date :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['booking_date'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Customer ID :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['customer_id'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'First Name :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['firstname'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Last Name :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['lastname'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Total :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50,7, $bookingData[0]['total'], 0, 1, 'L');

$pdf->Ln();
// Column headings
$header = array('Package','Duration','No of People','Price');

foreach ($bookingDetailData as $key => $value) {

    $pdf->SetFont('Times', 'B', 12);    
    $data[] = array(
        'package_title' => $value['package_title'],
        'duration' => $value['duration'],
        'no_of_people' => $value['no_of_people'],
        'price' => $value['price'],
    );
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>