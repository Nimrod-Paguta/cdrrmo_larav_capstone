<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Reports\PdfReport;
use App\Models\Register;

class RegisteredUserReportController extends Controller
{
    public function index()
    {
        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(0, 10, 'REGISTERED USERS ', 0,0,'L');
        $fpdf->SetFont('Arial', 'B', 12);

        $fpdf->Ln(12);
        $header_registeredusers = array('Name', 'Address','Phone No.','Vehicle Brand','Vehicle License','Date Registered');
        
        // Fetch registered users data from the database
        $registeredUsers = Register::all();

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

        $fpdf->Output();
        exit;
    }
}
