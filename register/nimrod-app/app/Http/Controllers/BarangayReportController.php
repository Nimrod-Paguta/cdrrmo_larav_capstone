<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Reports\PdfReport;
use App\Models\Report;
use App\Models\Register;

class BarangayReportController extends Controller
{
    public function index()
    {
        // Display your barangay report page
    }
    public function generateReport($id)
{
    // Fetch data for the selected barangay from the database
    $barangayReports = Report::where('barangay', $id)->get();

    // Fetch additional data from the Register model for the selected barangay
    $registerData = Register::where('barangay', $id)->pluck('id');

    // Generate PDF report using fetched data
    $fpdf = new PdfReport('P', 'mm', 'A4');
    $fpdf->AddPage();
    $fpdf->SetFont('Arial', 'B', 14);
    $fpdf->Cell(101, 10, 'ACCIDENT REPORTS IN BARANGAY ' . strtoupper($id), 0, 0, 'L');
    $fpdf->SetFont('Arial', 'B', 12);
    $fpdf->Ln(12);

    $fpdf->SetFont('Arial', 'B', 12);
    $header_vehicle = array('Full Name', 'Phone No.', 'G-Force', 'Vehicle Model', 'Date of Accident');
    $data_vehicle = array();

    // Iterate through each report from the selected barangay
    foreach ($barangayReports as $report) {
        // Find the corresponding register data for each report
        $register = Register::find($report->registereduserid);
        $totalReports = $barangayReports->count();
        if ($report->gforce >= 0 && $report->gforce <= 4) {
            $accidentSeverity = 'No Accident';
        } elseif ($report->gforce > 4 && $report->gforce <= 20) {
            $accidentSeverity = 'Mild Accident';
        } elseif ($report->gforce > 20 && $report->gforce <= 40) {
            $accidentSeverity = 'Medium Accident';
        } else {
            $accidentSeverity = 'Severe Accident';
        }
        if ($register) {
            // If register data exists for this report, add it to the PDF data array
            $data_vehicle[] = array(
                $register->name,
                $register->contactnumber,
                $accidentSeverity, 
                $register->brand . ' ' . $register->model,
                $report->created_at->format('Y-m-d'),
            );
        }
    }

    $fpdf->BarangayReportTable($header_vehicle, $data_vehicle);
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
