<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Reports\PdfReport;
use App\Models\Register;
use App\Models\Report;

class IndividualReportController extends Controller
{
    public function index($id) {
        // Retrieve the registered user based on the provided ID
        $register = Register::findOrFail($id);

        // Retrieve the accident reports associated with the registered user
        $reports = Report::where('registereduserid', $id)->get();
        $totalReports = $reports->count();

        // Prepare data for the PDF report table
        $data_vehicle = [];
        foreach ($reports as $report) {

            if ($report->gforce >= 0 && $report->gforce <= 4) {
                $accidentSeverity = 'Safe';
            } elseif ($report->gforce > 4 && $report->gforce <= 20) {
                $accidentSeverity = 'Low';
            } elseif ($report->gforce > 20 && $report->gforce <= 40) {
                $accidentSeverity = 'Moderate';
            } else {
                $accidentSeverity = 'Severe';
            }
            $data_vehicle[] = [
                $register->name . ' ' . $register->lastname, // Access registered user's name and lastname
                $register->contactnumber,
                $accidentSeverity, 
                $register->model,
                $report->barangay,
                $report->created_at->format('d/m/Y'),
            ];
        }

        // Generate PDF report
        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $currentDate = date('Y-m-d'); 
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->SetXY(10, 45); 
        $fpdf->Cell(12, 10, 'Date: ', 0, 0, 'L');
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(0, 10, $currentDate, 0, 0, 'L'); 
        $fpdf->Ln(10);
    

        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(101, 10, 'Total Accident By: ' . $register->name . ' '. $register->lastname, 0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Ln(12);

        $header_vehicle = array('Full Name','Phone No.', 'G-Force','Vehicle Model', 'Location','Date of Accident');

        $fpdf->IndividualReportTable($header_vehicle, $data_vehicle);
        $fpdf->Ln(10);
        
        // Add remaining content...

        

        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(40, 10, 'TOTAL REPORTS: ', 0,0,'L');
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(0, 10, $totalReports, 0,0,'L');
        $fpdf->Ln(20);

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
