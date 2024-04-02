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
        $reports = Report::all();
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
        // return view('welcome');
        $validatedData = $request->validate([
            'registereduserid' => 'required|integer|exists:registers,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gforce' => 'required|numeric',
            'status' => 'required|string',
            'barangay' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string'
        ]);

        $report = Report::create($request->all());
    
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);
        $register = Register::findOrFail($report->id);
        return view('reporting.view', compact('report', 'register'));
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
