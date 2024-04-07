<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class barangayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        // Fetch the total number of reports for each barangay
        $totalReportsByBarangay = DB::table('reports')
        ->select('barangay', 'city', DB::raw('COUNT(*) as total_reports'))
        ->groupBy('barangay', 'city')
        ->get();
    

        
        // Pass the total number of reports by barangay to the view
        return view('barangay', ['totalReportsByBarangay' => $totalReportsByBarangay]);
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
