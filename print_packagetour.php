<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/packageTourHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        
        $this->Cell(50, 7, 'Package ID', 1);
        $this->Cell(50, 7, 'Package', 1);
        $this->Cell(50, 7, 'Duration', 1);
        $this->Cell(50, 7, 'Hotel', 1);
        $this->Cell(50, 7, 'Pirce', 1);        

        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(50,7, $row['package_id'], 1);
            $this->Cell(50,7, $row['package_title'], 1);
            $this->Cell(50, 7, $row['duration'], 1);
            $this->Cell(50, 7, $row['hotel'], 1);
            $this->Cell(50, 7, $row['price'], 1);            
                      
            $this->Ln();
        }
    }

}

//***************************************************************************************************************
$packageTourData=  packageTourHelper::selectAll();
//***************************************************************************************************************
// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Package Tour Report', 0, 1, 'C');

$pdf->Ln();

// Column headings
//$header = array('Package','Duration','No of People','Price');
$header=array();

foreach ($packageTourData as $key => $value) {

    $pdf->SetFont('Times', 'B', 12);    
    $data[] = array(
        'package_id' => $value['package_id'],
        'package_title' => $value['title'],
        'duration' => $value['duration'],
        'hotel' => $value['hotel'],
        'price' => $value['price'],
    );
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>