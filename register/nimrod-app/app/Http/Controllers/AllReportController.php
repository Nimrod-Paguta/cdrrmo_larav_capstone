<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Register;
use App\Http\Controllers\Reports\PdfReport;
use Illuminate\Support\Facades\Redis;

class AllReportController extends Controller
{
    public function index($reports, $stamp){

        $upperCaseStamp = strtoupper($stamp);
        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(101, 10, 'ACCIDENT REPORTS IN MALAYBALAY CITY AS OF ' . $upperCaseStamp, 0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Ln(12);

        $fpdf->SetFont('Arial', 'B', 12);
        $header_vehicle = array('Full Name','Phone No.', 'Severity','Vehicle Model', 'Location','Date of Accident');
        $totalReports = $reports->count();
        
        $data_vehicle = [];
        foreach ($reports as $report) {
            $registeredUser = Register::find($report->registereduserid); // Retrieve the register data by ID
            if ($report->gforce >= 0 && $report->gforce <= 4) {
                $accidentSeverity = 'Safe';
            } elseif ($report->gforce > 4 && $report->gforce <= 20) {
                $accidentSeverity = 'Low';
            } elseif ($report->gforce > 20 && $report->gforce <= 40) {
                $accidentSeverity = 'Moderate';
            } else {
                $accidentSeverity = 'Severe';
            }

            $nameWidth = strlen($registeredUser->name .  ' ' . $registeredUser->lastname) * 2;
            $data_vehicle[] = array(
                $registeredUser->name .  ' ' . $registeredUser->lastname,
                $registeredUser->contactnumber,
                $accidentSeverity,
                $registeredUser->model,
                $report->barangay,
                explode(' ', $report->created_at)[0],
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

    public function allTime(){
        $reports = Report::all();
        $stamp = 'All Time';
        $this->index($reports, $stamp);
    }

    public function thisWeek()
    {
        // Get the start and end dates of the current week
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();

        // Query to get the registers created within the current week
        $reports = Report::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

        // Call the index method to generate PDF report
        $stamp = 'This Week';
        $this->index($reports, $stamp);
    }

        public function thisMonth()
    {
        // Get the start and end dates of the current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        // Query to get the registers created within the current month
        $reports = Report::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

        // Call the index method to generate PDF report
        $stamp = 'This Month';
        $this->index($reports, $stamp);
    }

    public function lastMonth()
    {
        // Get the start and end dates of the last month
        $startOfLastMonth = now()->subMonth()->startOfMonth()->toDateString();
        $endOfLastMonth = now()->subMonth()->endOfMonth()->toDateString();

        // Query to get the registers created within the last month
        $reports = Report::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->get();

        // Call the index method to generate PDF report
        $stamp = 'Last Month';
        $this->index($reports, $stamp);
    }

    public function thisYear()
    {
        // Get the start and end dates of the current year
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Query to get the registers created within the current year
        $reports = Report::whereBetween('created_at', [$startOfYear, $endOfYear])->get();

        $stamp = 'This Year';
        $this->index($reports, $stamp);
    }

    public function lastYear()
    {
        // Get the start and end dates of the last year
        $startOfLastYear = now()->subYear()->startOfYear()->toDateString();
        $endOfLastYear = now()->subYear()->endOfYear()->toDateString();

        // Query to get the registers created within the last year
        $reports = Report::whereBetween('created_at', [$startOfLastYear, $endOfLastYear])->get();

        // Call the index method to generate PDF report
        $stamp = 'Last Year';
        $this->index($reports, $stamp);
    }
}
