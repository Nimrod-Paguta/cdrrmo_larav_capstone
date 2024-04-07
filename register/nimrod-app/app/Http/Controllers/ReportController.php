<?php

namespace App\Http\Controllers;
use App\Models\Report; 
use App\Models\Register; 
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with('registereduserid')->get();
        return view('reporting', ['reports' => $reports]);
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
