<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register; 

class RegisterController extends Controller
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
        return view('registerpage'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'barangay' => 'required|string',
            'municipality' => 'required|string',
            'province' => 'required|string',
            'contactnumber' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'vehiclelicense' => 'required|string',
            'placard' => 'required|string',
            'color' => 'required|string',
            'date' => 'required|string',
        ]);

        $user = Register::create($validatedData);
    
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
        $registers = Register::findOrFail($id);
        return view('registerpage.edit', compact('registers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'barangay' => 'required|string',
            'municipality' => 'required|string',
            'province' => 'required|string',
            'contactnumber' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'vehiclelicense' => 'required|string',
            'placard' => 'required|string',
            'color' => 'required|string',
            'date' => 'required|string',
        ]);

        $registers = Register::findOrFail($id);
        $registers->update($request->all());

        return redirect()->route('registerpage')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registers = Register::findOrFail($id);
        $registers->delete();
    
        return redirect()->route('registerpage')->with('success', 'Student deleted successfully!');
    }

    public function getUserInfo(Request $request){

        $number = $request->sender;

        $user = Register::where('contactnumber', $number)->first();

        // You might want to handle cases where the user is not found
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Return the user information
        return response()->json($user);
    }
}
