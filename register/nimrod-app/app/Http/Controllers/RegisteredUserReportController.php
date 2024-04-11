<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Reports\PdfReport;
use App\Models\Register;

class RegisteredUserReportController extends Controller
{
    public function index($registeredUsers, $stamp)
    {
        $upperCaseStamp = strtoupper($stamp);
        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $currentDate = date('Y-m-d'); // Get current date

        // Place date at the bottom of the logo
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->SetXY(10, 45); // Adjust the X and Y coordinates as needed
        $fpdf->Cell(12, 10, 'Date: ', 0, 0, 'L');
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(0, 10, $currentDate, 0, 0, 'L'); // Display current date
        $fpdf->Ln(10);
    
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(0, 10, 'REGISTERED USERS AS OF '.$upperCaseStamp, 0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);

        $fpdf->Ln(12);
        $header_registeredusers = array('Name', 'Address','Phone No.','Vehicle Brand','Vehicle License','Date Registered');

        // Initialize an empty array to store data for the PDF table
        $data_registeredusers = [];
       

        // Loop through registered users data
        foreach ($registeredUsers as $user) {
            // Push data for each user into the $data_registeredusers array
            $data_registeredusers[] = [
                $user->name,
                $user->barangay,
                $user->contactnumber,
                $user->brand,
                $user->vehiclelicense,
                date('m/d/Y', strtotime($user->created_at))
            ];
        }

        // Generate table in PDF
        $fpdf->RegisteredUserTable($header_registeredusers, $data_registeredusers);
        $fpdf->Ln(10);
        $header_users = array();
        $data_users = array();


        $totalRegisteredUsers = count($registeredUsers);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(58, 10, 'TOTAL REGISTERED USER: ', 0,0,'L'); // Adjust the width of the cell for the text
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(0, 10, $totalRegisteredUsers, 0,0,'L'); // Adjust the position of the count
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
        $registeredUsers = Register::all();
        $stamp = 'All Time';
        $this->index($registeredUsers, $stamp);
    }

    public function thisWeek()
    {
        // Get the start and end dates of the current week
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();

        // Query to get the registers created within the current week
        $registeredUsers = Register::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

        // Call the index method to generate PDF report
        $stamp = 'This Week';
        $this->index($registeredUsers, $stamp);
    }

        public function thisMonth()
    {
        // Get the start and end dates of the current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        // Query to get the registers created within the current month
        $registeredUsers = Register::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

        // Call the index method to generate PDF report
        $stamp = 'This Month';
        $this->index($registeredUsers, $stamp);
    }

    public function lastMonth()
    {
        // Get the start and end dates of the last month
        $startOfLastMonth = now()->subMonth()->startOfMonth()->toDateString();
        $endOfLastMonth = now()->subMonth()->endOfMonth()->toDateString();

        // Query to get the registers created within the last month
        $registeredUsers = Register::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->get();

        // Call the index method to generate PDF report
        $stamp = 'Last Month';
        $this->index($registeredUsers, $stamp);
    }

    public function thisYear()
    {
        // Get the start and end dates of the current year
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Query to get the registers created within the current year
        $registeredUsers = Register::whereBetween('created_at', [$startOfYear, $endOfYear])->get();

        $stamp = 'This Year';
        $this->index($registeredUsers, $stamp);
    }

    public function lastYear()
    {
        // Get the start and end dates of the last year
        $startOfLastYear = now()->subYear()->startOfYear()->toDateString();
        $endOfLastYear = now()->subYear()->endOfYear()->toDateString();

        // Query to get the registers created within the last year
        $registeredUsers = Register::whereBetween('created_at', [$startOfLastYear, $endOfLastYear])->get();

        // Call the index method to generate PDF report
        $stamp = 'Last Year';
        $this->index($registeredUsers, $stamp);
    }
}
