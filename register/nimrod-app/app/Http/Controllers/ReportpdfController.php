<?php

namespace App\Http\Controllers;
use App\Models\Register;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Reports\PdfReport;

class ReportpdfController extends Controller 
{
    public function index($id){
        $report = Report::findOrFail($id);
        $register = Register::find($report->registereduserid);
        // $report = Report::find($register->id);


        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(0, 10, 'ACCIDENT REPORT', 0,0,'C');



        $fpdf->Ln(20);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, 10, 'DRIVER INFORMATION', 1,0,'L');
        $fpdf->Ln(20);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(24,0,'Full Name: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);   
        $fpdf->Cell(50,0,$register->name." ".$register->lastname ,0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(23,0,'Phone No: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(35,0,$register->contactnumber,0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(32,0,'Emergency No: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(0,0,$register->emergencynumber,0,0,'L');
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(22,0,'Address: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(75, 0, $register->barangay . ", " . $register->municipality, 0, 0, 'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(41,0,'Medical Condition: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(0,0,$register->medicalcondition,0,0,'L');
        $fpdf->Ln(20);

        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, 10, 'INCIDENT INFORMATION', 1,0,'L');
        $fpdf->Ln(20);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(20,0,'User ID: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(40,0,$report->registereduserid,0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(36,0,'Date of Incident: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(40, 0, '' . $report->created_at->format('Y-m-d'), 0, 0, 'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15,0,'Time: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(40, 0, '' . $report->created_at->format('H:i:s'), 0, 0, 'L');
        $fpdf->Ln(10);

        


        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(20,10,'Location: ',0,0,'L');
        $fpdf->SetFont('Arial', 'U', 12);

        $address = $report->address;
        $max_length = 40; // Maximum characters allowed for the address

        if (strlen($address) > $max_length) {
            // Insert line break
            $fpdf->MultiCell(0, 10, $address, 0, 'L');
        } else {
            $fpdf->Cell(0, 10, $address, 0, 0, 'L');
        }


        $fpdf->Ln(12);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(19,5,'Status: ',0,0,'L');
        
        $fpdf->SetTextColor(0, 128, 0);
        $underlineY = $fpdf->GetY() + 5; 
        $fpdf->Cell(70, 4,$report->status, 'B', 0, 'L');
        $fpdf->SetY($underlineY); 
        $fpdf->SetTextColor(0);
        $fpdf->Ln(20);


        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, 10, 'VEHICLE INFORMATION', 1,0,'L');
        $fpdf->Ln(20);
$header_vehicle = array('Brand', 'Model', 'Vehicle License', 'Vehicle Type', 'Color', 'Date Registered');
$data_vehicle = array(
    $register->brand,
    $register->model,
    $register->vehiclelicense,
    $register->type,
    $register->color,
    date('Y-m-d', strtotime($report->created_at))
);

$fpdf->BasicTable($header_vehicle, $data_vehicle);
$fpdf->Ln(10);
$header_incident = array();
$data_incident = array();


        



        $fpdf->Ln(30);
      
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(100, 10, 'Prepared by:', 0,0,'L');
        $fpdf->Cell(0, 10, 'Noted by:', 0,0,'L');
        $fpdf->Ln(15);
        
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(100, 10, 'Danilo C. Bautista', 0,0,'L');
        $fpdf->Cell(0, 10, 'Ana Andrea A. Ho', 0,0,'L');
        $fpdf->Ln(5);
        
        $fpdf->SetFont('Arial', '', 0);
        $fpdf->Cell(100, 10, '911 Communication Chief', 0,0,'L');
        $fpdf->Cell(0, 10, 'Communication and Command Central Chief', 0,0,'L');
        $fpdf->Ln(30);
        
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(100, 10, 'Approved by:', 0,0,'L');
        $fpdf->Ln(15);
        
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(100, 10, 'Alan J. Comiso', 0,0,'L');
        $fpdf->Ln(5);
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, 10, 'CGDH I (CDRRMO)', 0,0,'L');
        




        $fpdf->Output();
        exit;
    }
}
