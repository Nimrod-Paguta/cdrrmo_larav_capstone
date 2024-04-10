<?php

namespace App\Http\Controllers;
use App\Models\Report; 
use App\Models\Register; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with('registereduserid')->get();
        return view('reporting', [
            'reports' => $reports,
            'sort' => '0',
            'pdf' => '/allreports',
        ]);
    }

    public function getThisWeekReports()
    {
         // Get the start and end dates of the current week
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();

        // Query to get the count of reports created within the current week
        $reportData = Report::with('registereduserid')
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->get();
        
        return view('reporting', [
            'reports' => $reportData,
            'sort' => '1',
            'pdf' => '/reports-thisweek',
        ]);
    }

    public function getThisMonthReports()
    {
        // Get the start and end dates of the current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        // Query to get the registers created within the current month
        $reportData = Report::with('registereduserid')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get();

        return view('reporting', [
            'reports' => $reportData,
            'sort' => '2',
            'pdf' => '/reports-thismonth',
        ]);
    }

    public function getLastMonthReports()
    {
        // Get the start and end dates of the last month
        $startOfLastMonth = now()->subMonth()->startOfMonth()->toDateString();
        $endOfLastMonth = now()->subMonth()->endOfMonth()->toDateString();

        // Query to get the reportData created within the last month
        $reportData = Report::with('registereduserid')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->get();

        return view('reporting', [
            'reports' => $reportData,
            'sort' => '3',
            'pdf' => '/reports-lastmonth',
        ]);
    }

    public function getThisYearReports()
    {
        // Get the start and end dates of the current year
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Query to get the reportData created within the current year
        $reportData = Report::with('registereduserid')
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->get();

        return view('reporting', [
            'reports' => $reportData,
            'sort' => '4',
            'pdf' => '/reports-thisyear',
        ]);
    }

    public function getLastYearReports()
    {
        // Get the start and end dates of the last year
        $startOfLastYear = now()->subYear()->startOfYear()->toDateString();
        $endOfLastYear = now()->subYear()->endOfYear()->toDateString();

        // Query to get the reportData created within the last year
        $reportData = Report::with('registereduserid')
            ->whereBetween('created_at', [$startOfLastYear, $endOfLastYear])
            ->get();

        return view('reporting', [
            'reports' => $reportData,
            'sort' => '5',
            'pdf' => '/reports-lastyear',
        ]);
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
        $validatedData = $request->validate([
            'registereduserid' => 'required|exists:registers,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'time' => 'required|string',
            'gforce' => 'required|numeric',
            'status' => 'required|string',
            'month' => 'required|numeric',
            'barangay' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string'
        ]);

        $user = Report::create($validatedData);
    
        return redirect()->back()->with('success', 'Owner information saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);
        $register = Register::findOrFail($report->registereduserid);
        return view('reporting.view', compact('report', 'register'));
    }
     
    public function send(Request $request)
    {
        $id = $request->id;
        $report = Report::findOrFail($id);
        $contactNumbers = Register::pluck('contactnumber');

        return response()->json([
            'report' => $report,
            'contactNumbers' => $contactNumbers
        ]);
    
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
    
        $report = Report::findOrFail($id); // Find the report with the given ID
        $report->update($request->all()); // Update the report with the request data
    
        return redirect()->route('reporting.index')->with('success', 'Report updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $report = Report::findOrFail($id);
    $report->delete();

    return redirect()->route('reporting.index')->with('success', 'Report deleted successfully!');
}
}
