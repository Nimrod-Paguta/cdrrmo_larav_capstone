<?php

namespace App\Http\Controllers\Reports;

use Codedge\Fpdf\Fpdf\Fpdf;

class PdfReport extends FPDF
{
    function Header()
    {
        // Logo 1
        $this->Image('malaybalaylogo.png',10,6,30);
        // Logo 2
        $this->Image('cdrrmologo.png',170,6,30);
        
        // Title
        $this->Ln(7);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0,'City Disaster Risk Reduction Management Office',0,0,'C');
        $this->Ln(7);
        $this->Cell(0,0,'Malaybalay City, Bukidnon',0,0,'C');
      
       
        // Line break
        $this->Ln(20);
    }
   
    function BasicTable($header, $data)
    {

        $this->SetFont('Arial', 'B', 11);

        // Header
        foreach($header as $col)
            $this->Cell(31.6,10,$col,1);
        $this->Ln();
        // Data

        $this->SetFont('Arial', '', 10);

        foreach($data as $col)
            $this->Cell(31.6,10,$col,1);
        $this->Ln();
    }

    function ReportTable($header, $data)
{
    $this->SetFont('Arial', 'B', 11);

    // Header
    foreach($header as $col)
        $this->Cell(90,10,$col,1,0,'C');
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 10);
    foreach($data as $row) {
        foreach($row as $col) {
            // Center align the cell
            $this->Cell(90,10,$col,1,0,'C');
        }
        $this->Ln();
    }
}



function RegisteredUserTable($header, $data)
{
    $this->SetFont('Arial', 'B', 11);

    // Header
    foreach($header as $col)
        $this->Cell(32,10,$col,1,0,'L');
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 10);
    foreach($data as $row) {
        foreach($row as $col) {
            // Center align the cell
            $this->Cell(32,10,$col,1,0,'L');
        }
        $this->Ln();
    }
}

function BarangayReportTable($header, $data)
{
    $this->SetFont('Arial', 'B', 11);

    // Header
    foreach($header as $col)
        $this->Cell(38,10,$col,1,0,'L');
    $this->Ln();
    
    // Data
    $this->SetFont('Arial', '', 10);
    foreach($data as $row) {
        foreach($row as $col) {
            $this->Cell(38,10,$col,1,0,'L');
        }
        $this->Ln(); 
    }
}








    function Footer()
    {


        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Date: '.date('m/d/Y'), 0, 0, 'L');


        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
         $this->Cell(0, 10, 'Page '.$this->PageNo(), 0, 0, 'R');
    }
}

    