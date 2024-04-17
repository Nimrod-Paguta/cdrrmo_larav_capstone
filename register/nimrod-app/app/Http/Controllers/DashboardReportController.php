<?php

namespace App\Http\Controllers;
use App\Models\Register;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Reports\PdfReport;

class DashboardReportController extends Controller
{
    public function index(){

        
        $totalRegistered = $this->getTotalRegistered();
        $totalReported = $this->getTotalReported();
        $totalCompletedReports = $this->getTotalCompletedReports();
        $totalVehicle = $this->getTotalVehicle();

            
    // Fetch recent registered users
    $recentRegisters = Register::orderBy('created_at', 'desc')->take(5)->get();


    $monthlyReportData = [];

    // Loop through months from February to December
    for ($i = 2; $i <= 12; $i++) {
        // Get the month in YYYY-MM format
        $month = sprintf('%d-%02d', 2023, $i);

        // Count reports for the current month
        $reportCount = Report::where('month', $month)->count();

        // Add the report count to the monthly report data array
        $monthlyReportData[date("F", strtotime($month))] = $reportCount;
    }

    

        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'U', 12);
        $fpdf->Cell(0, 10, 'Date: '.date('m/d/Y'), 0, 0, 'L');
        $fpdf->Ln(20);
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(0, 0, 'OVERALL ACCIDENT REPORT', 0,0,'C');
        $fpdf->Ln(20);


        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, 0, 'Recently Added Users', 0,0,'L');
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial', 'B', 12);
        $header_recent_registers = array('ID', 'Full Name', 'Contact Number', 'Driver Status');
        $data_recent_registers = [];
    
        foreach ($recentRegisters as $user) {
            $data_recent_registers[] = [$user->id, $user->name.' '.$user->middlename.' '.$user->lastname, $user->contactnumber, $user->type];
        }
        
    
$fpdf->DashboardTable($header_recent_registers, $data_recent_registers);
$fpdf->Ln(10);
$header_incident = array();
$data_incident = array();



$fpdf->SetFont('Arial', 'B', 12);
$fpdf->Cell(0, 0, 'Total Reports by barangay', 0,0,'L');
$fpdf->Ln(10);


$fpdf->SetFont('Arial', '', 10);
$data = array(
            'Total Registered' => $totalRegistered, 
            'Total Reported' => $totalReported, 
            'Total Completed Reports' => $totalCompletedReports, 
            'Total Vehicle' => $totalVehicle
        );
$valX = $fpdf->GetX();
$valY = $fpdf->GetY();
$fpdf->SetXY(20, $valY);
$col1=array(100,100,255);
$col2=array(255,100,100);
$col3=array(255,255,100);
$col4=array(100,255,100); 
$fpdf->PieChart(140, 70, $data, '%l (%p)', array($col1,$col2,$col3,$col4)); // Updated function call with the new color
$fpdf->SetXY($valX, $valY + 40);




// Get monthly report counts
// Get monthly report counts
$monthlyReports = Report::selectRaw("DATE_FORMAT(`time`, '%Y-%m') AS `month`, COUNT(*) AS `total_reports`")
    ->groupBy('month', 'time')
    ->orderBy('month')
    ->pluck('total_reports', 'month')
    ->toArray();



// Prepare data for the line graph
$data = [
    'Group 1' => $monthlyReports
];

// Prepare labels for the line graph (from February to December)
// Prepare labels for the line graph (from January to December)
$months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];

// Map the monthly report counts to their corresponding month labels
$monthlyData = [];
foreach ($months as $month) {
    $monthYear = '2023-' . str_pad(array_search($month, $months) + 1, 2, '0', STR_PAD_LEFT); // Assuming starting from January 2023
    $totalReports = isset($monthlyReports[$monthYear]) ? $monthlyReports[$monthYear] : 0;
    $monthlyData[$month] = $totalReports;
}

// Replace the data in $data with the monthly totals
$data['Group 1'] = $monthlyData;




$fpdf->AddPage();
// Display options: horizontal lines, bounding boxes around the plotting area and the entire area
// Colors: random
// Max ordinate: 20
// Number of divisions: 10
$fpdf->LineGraph(190,100,$data,'HgBdB',null,20,10);




        
        $fpdf->Output();
        exit;
    }


    public function getTotalRegistered()
    {
        return Register::count();
    }
      
    public function getTotalVehicle()
    {
        return Register::whereNotNull('vehiclelicense')->count();
    }

    public function getTotalReported()
    {
        return Report::count();
    }

    public function getTotalCompletedReports()
    {
        return Report::where('status', 'completed')->count();
    }
}
