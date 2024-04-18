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
        $currentDate = date('Y-m-d'); 
        $fpdf->AddPage();
        $fpdf->Cell(14, 10, 'Date: ', 0, 0, 'L');
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(0, 10, $currentDate, 0, 0, 'L');
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


$fpdf->Ln(120);
$data = Report::select('barangay', \DB::raw('COUNT(*) as total'))
->groupBy('barangay')
->orderByDesc('total')
->limit(10)
->pluck('total', 'barangay')
->toArray();

// Bar diagram
$fpdf->SetFont('Arial', 'B', 12);
$fpdf->Cell(0, 5, 'Top Barangays', 0, 0);
$fpdf->Ln(8);
$valX = $fpdf->GetX();
$valY = $fpdf->GetY();
$fpdf->BarDiagram(190, 70, $data, '%l', array(255,175,100)); 
$fpdf->SetXY($valX, $valY + 80);




$fpdf->Ln(10);
      
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

    public function getTopBarangays(){
        $barangay = Report::select('barangay', \DB::raw('COUNT(*) as total'))
                        ->groupBy('barangay')
                        ->orderByDesc('total')
                        ->limit(10)
                        ->pluck('total', 'barangay');

        dd($barangay);
    }
}
