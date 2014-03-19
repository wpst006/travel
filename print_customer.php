<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/customerHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header

        $this->Cell(30, 7, 'Customer ID', 1);
        $this->Cell(50, 7, 'First Name', 1);
        $this->Cell(50, 7, 'Last Name', 1);
        $this->Cell(30, 7, 'Passport No', 1);
        $this->Cell(50, 7, 'Country', 1);
        $this->Cell(30, 7, 'Postal Code', 1);
        $this->Cell(30, 7, 'Phone No', 1);

        $this->Ln();
        // Data
        foreach ($data as $row) {

            $this->SetFont('Times', '', 12);
            $this->Cell(30,7, $row['customer_id'], 1);
            $this->Cell(50,7, $row['firstname'], 1);
            $this->Cell(50, 7, $row['lastname'], 1);
            $this->Cell(30, 7, $row['passport_no'], 1);
            $this->Cell(50, 7, $row['country'], 1);
            $this->Cell(30, 7, $row['postalcode'], 1);
            $this->Cell(30, 7, $row['phone_no'], 1);

            $this->Ln();
        }
    }

}

//***************************************************************************************************************
if (isset($_GET['searchKey'])){
    $customerData=  customerHelper::searchCustomer($_GET['searchKey']);
}else{
    $customerData= customerHelper::selectAll();
}
//***************************************************************************************************************
// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Customer Report', 0, 1, 'C');

$pdf->Ln();

// Column headings
//$header = array('Package','Duration','No of People','Price');
$header=array();

foreach ($customerData as $key => $value) {

    $pdf->SetFont('Times', 'B', 12);
    $data[] = array(
        'customer_id' => $value['customer_id'],
        'firstname' => $value['firstname'],
        'lastname' => $value['lastname'],
        'passport_no' => $value['passport_no'],
        'country' => $value['country'],
        'postalcode' => $value['postalcode'],
        'phone_no' => $value['phone_no'],
    );
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>