<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Reports\PdfReport;
use App\Models\Report; // Make sure to import the Report model

class ReportControllerAll extends Controller
{
    public function index()
    {
        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(80, 10, 'ACCIDENT REPORTS AS OF 2024', 0,0,'L');
       

        $fpdf->Ln(12);
        $fpdf->SetFont('Arial', 'B', 12);
        
        // Fetch dynamic data from the database
        $reports = Report::select('barangay', \DB::raw('COUNT(*) as total_reports'))
                         ->groupBy('barangay')
                         ->orderBy('total_reports', 'desc')
                         ->get();

        $header_allreports = ['Barangay', 'No. of Report'];
        $data_allreports = [];

        foreach ($reports as $report) {
            $data_allreports[] = [$report->barangay, $report->total_reports];
        }

        $fpdf->ReportTable($header_allreports, $data_allreports);
        $fpdf->Ln(10);
        
        // Calculate total reports
        $total_reports = Report::count();
        
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(40, 10, 'TOTAL REPORTS: ', 0,0,'L');
        $fpdf->SetFont('Arial', 'BU', 12);
        $fpdf->Cell(0, 10, $total_reports, 0,0,'L');
        $fpdf->Ln(20);

        // Footer
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
