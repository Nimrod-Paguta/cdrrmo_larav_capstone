<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ChartDataController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        
        // Fetch total reports for each month from the database for the selected year
        $totalReportsByMonth = [];
        for ($month = 1; $month <= 12; $month++) {
            $totalReportsByMonth[$month] = Report::whereYear('created_at', $selectedYear)
                ->whereMonth('created_at', $month)
                ->count();
        }

        // Fetch total reports for each month and year for detailed data
        $specificMonthData = Report::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('dashboard', compact('totalReportsByMonth', 'specificMonthData', 'selectedYear'));
    }
}
