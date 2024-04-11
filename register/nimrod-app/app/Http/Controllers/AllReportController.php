<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Register;
use App\Http\Controllers\Reports\PdfReport;


class AllReportController extends Controller
{
    public function index(){
        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(101, 10, 'ACCIDENT REPORTS IN MALAYBALAY CITY', 0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Ln(12);

        $fpdf->SetFont('Arial', 'B', 12);
        $header_vehicle = array('Full Name','Phone No.', 'G-Force','Vehicle Model', 'Location','Date of Accident');
        $reportData = Report::with('registereduserid')->get();
        $totalReports = $reportData->count();
        
        $data_vehicle = [];
        foreach ($reportData as $report) {
            $registeredUser = Register::find($report->registereduserid); // Retrieve the register data by ID
            if ($report->gforce >= 0 && $report->gforce <= 4) {
                $accidentSeverity = 'No Accident';
            } elseif ($report->gforce > 4 && $report->gforce <= 20) {
                $accidentSeverity = 'Mild Accident';
            } elseif ($report->gforce > 20 && $report->gforce <= 40) {
                $accidentSeverity = 'Medium Accident';
            } else {
                $accidentSeverity = 'Severe Accident';
            }

            $nameWidth = strlen($registeredUser->name .  ' ' . $registeredUser->lastname) * 2;
            $data_vehicle[] = array(
                $registeredUser->name .  ' ' . $registeredUser->lastname,
                $registeredUser->contactnumber,
                $accidentSeverity,
                $registeredUser->model,
                $report->barangay,
                $report->time,
            );
        }

$fpdf->AllReportTable($header_vehicle, $data_vehicle);
$fpdf->Ln(10);
$header_incident = array();
$data_incident = array();



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
