<?php

namespace App\Http\Controllers;
use App\Models\Register; 
use Illuminate\Http\Request;
use App\Models\Report; 

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recentRegisters = Register::orderBy('created_at', 'desc')->take(5)->get();
        $registers = Register::all(); // Fetch all registered users
        return view('dashboard', compact('registers', 'recentRegisters'));
    }
    

      
    public function getTotalVehicle()
    {
        $totalVehicle = Register::whereNotNull('vehiclelicense')->count();
    
        return $totalVehicle;
    }

    public function dashregister()
{
    $registers = Register::all(); // Fetch all registered users
    return view('dashboard', compact('registers')); // Pass the $registers variable to the view
}

    
    public function getTotalReported()
    {
        $totalReported = Report::count();

        return $totalReported;
    }



    
    public function getTotalCompletedReports()
    {
        $totalCompletedReports = Report::where('status', 'completed')->count();

        return $totalCompletedReports;
    }


    public function getTotalCompletedReportsByTimestamp()
{
    // Assuming 'created_at' is a timestamp column in your database table
    $totalReports = Report::whereYear('created_at', '=', now()->year)
                          ->whereMonth('created_at', '=', now()->month)
                          ->count();

    return $totalReports;
}

public function getAllTimeReports()
{
    // Query to get the count of reports created on each day
    $reportData = Report::selectRaw('DATE(created_at) as date, COUNT(*) as count')
    ->groupBy('date')
    ->get();

    // Format the data into the structure required by Chart.js
    $labels = $reportData->pluck('date')->toArray();
    $counts = $reportData->pluck('count')->toArray();

    $data = [
        'labels' => $labels,
        'counts' => $counts,
    ];

    // Return the data as JSON
    return response()->json($data);
}

public function getThisWeekReports()
{
    // Get the start and end dates of the current week
    $startOfWeek = now()->startOfWeek()->toDateString();
    $endOfWeek = now()->endOfWeek()->toDateString();

    // Query to get the count of reports created within the current week
    $reportData = Report::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->groupBy('date')
        ->get();

    // Format the data into the structure required by Chart.js
    $labels = $reportData->pluck('date')->toArray();
    $counts = $reportData->pluck('count')->toArray();

    $data = [
        'labels' => $labels,
        'counts' => $counts,
    ];

    // Return the data as JSON
    return response()->json($data);
}

public function getThisMonthsReports()
{
    // Get the start and end dates of the current month
    $startOfMonth = now()->startOfMonth()->toDateString();
    $endOfMonth = now()->endOfMonth()->toDateString();

    // Query to get the count of reports created within the current month
    $reportData = Report::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->groupBy('date')
        ->get();

    // Format the data into the structure required by Chart.js
    $labels = $reportData->pluck('date')->toArray();
    $counts = $reportData->pluck('count')->toArray();

    $data = [
        'labels' => $labels,
        'counts' => $counts,
    ];

    // Return the data as JSON
    return response()->json($data);
}

public function getLastMonthReports()
{
    // Get the start and end dates of the last month
    $startOfMonth = now()->subMonth()->startOfMonth()->toDateString();
    $endOfMonth = now()->subMonth()->endOfMonth()->toDateString();

    // Query to get the count of reports created within the last month
    $reportData = Report::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->groupBy('date')
        ->get();

    // Format the data into the structure required by Chart.js
    $labels = $reportData->pluck('date')->toArray();
    $counts = $reportData->pluck('count')->toArray();

    $data = [
        'labels' => $labels,
        'counts' => $counts,
    ];

    // Return the data as JSON
    return response()->json($data);
}

public function getThisYearReports()
{
    // Get the start and end dates of the current year
    $startOfYear = now()->startOfYear()->toDateString();
    $endOfYear = now()->endOfYear()->toDateString();

    // Query to get the count of reports created within the current year
    $reportData = Report::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startOfYear, $endOfYear])
        ->groupBy('date')
        ->get();

    // Format the data into the structure required by Chart.js
    $labels = $reportData->pluck('date')->toArray();
    $counts = $reportData->pluck('count')->toArray();

    $data = [
        'labels' => $labels,
        'counts' => $counts,
    ];

    // Return the data as JSON
    return response()->json($data);
}

public function getLastYearReports()
{
    // Get the start and end dates of last year
    $startOfYear = now()->startOfYear()->subYear()->toDateString();
    $endOfYear = now()->endOfYear()->subYear()->toDateString();

    // Query to get the count of reports created within last year
    $reportData = Report::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startOfYear, $endOfYear])
        ->groupBy('date')
        ->get();

    // Format the data into the structure required by Chart.js
    $labels = $reportData->pluck('date')->toArray();
    $counts = $reportData->pluck('count')->toArray();

    $data = [
        'labels' => $labels,
        'counts' => $counts,
    ];

    // Return the data as JSON
    return response()->json($data);
}


    public function getTotalPublicVehicle()
    {
        $totalPublicVehicle = Register::where('type', 'Public')->count();

        return $totalPublicVehicle;
    }

    public function getTotalPrivateVehicle()
    {
        $totalPrivateVehicle = Register::where('type', 'Private')->count();

        return $totalPrivateVehicle;
    }    

    public function getTotalRegistered()
    {
        $totalRegistered = Register::count();

        return $totalRegistered;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function registerpage()
    {
        $registers = Register::all(); 
        return view('dashboard')->with('registers', $registers);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
