<?php

namespace App\Http\Controllers;
use App\Models\Report; 
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'registereduserid' => 'required|string',
            'location' => 'nullable|string',
            'time' => 'required|string',
            'gforce' => 'required|string',
            'status' => 'required|string',
            'date' => 'required|string',
        ]);

        $user = Report::create($validatedData);
    
        // Process the data as needed (e.g., store in the database)
        // ...
    // dd($validatedData); 
        return redirect()->back()->with('success', 'Owner information saved successfully.');

        
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
