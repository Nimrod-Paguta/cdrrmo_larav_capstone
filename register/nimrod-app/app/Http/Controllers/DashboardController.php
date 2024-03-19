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
        //
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

    public function getTotalCompletedReportsJanuary()
    {
        $totalJanuary = Report::where('month', 'January')->count();

        return $totalJanuary;
    }


    public function getTotalCompletedReportsFebruay()
    {
        $totalfebruary = Report::where('month', 'February')->count();

        return $totalfebruary;
    }


    public function getTotalCompletedReportsMarch()
    {
        $totalMarch = Report::where('month', 'March')->count();

        return $totalMarch;
    }

    public function getTotalCompletedReportsMay()
    {
        $totalMay = Report::where('month', 'May')->count();

        return $totalMay;
    }


    public function getTotalCompletedReportsApril()
    {
        $totalApril = Report::where('month', 'April')->count();

        return $totalApril;
    }

    
    public function getTotalCompletedReportsJune()
    {
        $totalJune = Report::where('month', 'June')->count();

        return $totalJune;
    }

    public function getTotalCompletedReportsJuly()
    {
        $totalJuly = Report::where('month', 'July')->count();

        return $totalJuly;
    }

    public function getTotalCompletedReportsAug()
    {
        $totalAug = Report::where('month', 'August')->count();

        return $totalAug;
    }

    public function getTotalCompletedReportsSep()
    {
        $totalSep = Report::where('month', 'September')->count();

        return $totalSep;
    }

    public function getTotalCompletedReportsOct()
    {
        $totalOct = Report::where('month', 'October')->count();

        return $totalOct;
    }

    public function getTotalCompletedReportsNovember()
    {
        $totalNovember = Report::where('month', 'November')->count();

        return $totalNovember;
    }

    public function getTotalCompletedReportsDecember()
    {
        $totalDecember = Report::where('month', 'December')->count();

        return $totalDecember;
    }


    public function getTotalCompletedReportsByTimestamp()
{
    // Assuming 'created_at' is a timestamp column in your database table
    $totalReports = Report::whereYear('created_at', '=', now()->year)
                          ->whereMonth('created_at', '=', now()->month)
                          ->count();

    return $totalReports;
}




public function getTotalCompletedReportsByMonth()
{
    $totalReportsByMonth = [];
    
    for ($month = 1; $month <= 12; $month++) {
        $totalReportsByMonth[] = Report::whereMonth('created_at', $month)->count();
    }

    return $totalReportsByMonth;
}


public function getTotalCompletedReportsInJanuary()
{
    $totalReportsInJanuary = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of January
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for January and the current year
        $specificDate = $currentYear . '-01-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in January
        $totalReportsInJanuary[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInJanuary;
}

public function getTotalCompletedReportsInMarch()
{
    $totalReportsInMarch = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of March
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for March and the current year
        $specificDate = $currentYear . '-03-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in March
        $totalReportsInMarch[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInMarch;
}

public function getTotalCompletedReportsInFebruary()
{
    $totalReportsInFebruary = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of February
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for February and the current year
        $specificDate = $currentYear . '-02-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in February
        $totalReportsInFebruary[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInFebruary;
}

public function getTotalCompletedReportsInApril()
{
    $totalReportsInApril = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of April
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for April and the current year
        $specificDate = $currentYear . '-04-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in April
        $totalReportsInApril[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInApril;
}

public function getTotalCompletedReportsInMay()
{
    $totalReportsInMay = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of May
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for May and the current year
        $specificDate = $currentYear . '-05-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in May
        $totalReportsInMay[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInMay;
}

public function getTotalCompletedReportsInJune()
{
    $totalReportsInJune = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of June
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for June and the current year
        $specificDate = $currentYear . '-06-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in June
        $totalReportsInJune[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInJune;
}

public function getTotalCompletedReportsInJuly()
{
    $totalReportsInJuly = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of July
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for July and the current year
        $specificDate = $currentYear . '-07-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in July
        $totalReportsInJuly[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInJuly;
}

public function getTotalCompletedReportsInAugust()
{
    $totalReportsInAugust = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of August
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for August and the current year
        $specificDate = $currentYear . '-08-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in August
        $totalReportsInAugust[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInAugust;
}

public function getTotalCompletedReportsInSeptember()
{
    $totalReportsInSeptember = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of September
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for September and the current year
        $specificDate = $currentYear . '-09-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in September
        $totalReportsInSeptember[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInSeptember;
}


public function getTotalCompletedReportsInOctober()
{
    $totalReportsInOctober = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of October
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for October and the current year
        $specificDate = $currentYear . '-10-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in October
        $totalReportsInOctober[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInOctober;
}


public function getTotalCompletedReportsInNovember()
{
    $totalReportsInNovember = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of November
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for November and the current year
        $specificDate = $currentYear . '-11-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in November
        $totalReportsInNovember[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInNovember;
}

public function getTotalCompletedReportsInDecember()
{
    $totalReportsInDecember = [];

    // Get the current year
    $currentYear = date('Y');

    // Loop through each day of December
    for ($day = 1; $day <= 31; $day++) {
        // Format the specific date for December and the current year
        $specificDate = $currentYear . '-11-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Fetch total reports for the specific date in December
        $totalReportsInDecember[] = Report::whereDate('created_at', $specificDate)->count();
    }

    return $totalReportsInDecember;
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


    public function recentRegisters()
{
    // Fetch the recent registered users, ordered by their creation date
    $recentRegisters = Register::orderBy('created_at', 'desc')->take(5)->get();
    
    return view('dashboard')->with('recentRegisters', $recentRegisters);
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
