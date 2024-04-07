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
        if ($register) {
            // If register data exists for this report, add it to the PDF data array
            $data_vehicle[] = array(
                $register->name,
                $register->contactnumber,
                $report->gforce,
                $register->brand . ' ' . $register->model,
                $report->created_at->format('Y-m-d'),
            );
        }
    }

    $fpdf->BarangayReportTable($header_vehicle, $data_vehicle);
    $fpdf->Ln(10);
    $header_incident = array();
    $data_incident = array();

    $fpdf->Output();
    exit;
}


}
