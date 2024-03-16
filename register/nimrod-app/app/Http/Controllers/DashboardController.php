<?php

namespace App\Http\Controllers;
use App\Models\Register; 
use Illuminate\Http\Request;
use App\Models\Report; 

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
