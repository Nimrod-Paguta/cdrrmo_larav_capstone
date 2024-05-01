<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Mail\HelloMail; 
use Illuminate\Support\Facades\Mail; 



class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getRegisters()
    {
        $registersRaw = DB::table('registers')->get()->toArray();
        $registers = array_reverse($registersRaw);
        return view('registerpage', [
            'registers' => $registers,
            'sort' => '0',
            'pdf' => '/registeredusers',
        ]);
    }

    public function getThisWeekRegisters()
    {
         // Get the start and end dates of the current week
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();

        // Query to get the count of reports created within the current week
        $reportData = DB::table('registers')
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->get();
        
        return view('registerpage', [
            'registers' => $reportData,
            'sort' => '1',
            'pdf' => '/registeredusers-thisweek',
        ]);
    }

    public function getThisMonthRegisters()
    {
        // Get the start and end dates of the current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        // Query to get the registers created within the current month
        $registers = DB::table('registers')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get();

        return view('registerpage', [
            'registers' => $registers,
            'sort' => '2',
            'pdf' => '/registeredusers-thismonth',
        ]);
    }

    public function getLastMonthRegisters()
    {
        // Get the start and end dates of the last month
        $startOfLastMonth = now()->subMonth()->startOfMonth()->toDateString();
        $endOfLastMonth = now()->subMonth()->endOfMonth()->toDateString();

        // Query to get the registers created within the last month
        $registers = DB::table('registers')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->get();

        return view('registerpage', [
            'registers' => $registers,
            'sort' => '3',
            'pdf' => '/registeredusers-lastmonth',
        ]);
    }

    public function getThisYearRegisters()
    {
        // Get the start and end dates of the current year
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();

        // Query to get the registers created within the current year
        $registers = DB::table('registers')
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->get();

        return view('registerpage', [
            'registers' => $registers,
            'sort' => '4',
            'pdf' => '/registeredusers-thisyear',
        ]);
    }

    public function getLastYearRegisters()
    {
        // Get the start and end dates of the last year
        $startOfLastYear = now()->subYear()->startOfYear()->toDateString();
        $endOfLastYear = now()->subYear()->endOfYear()->toDateString();

        // Query to get the registers created within the last year
        $registers = DB::table('registers')
            ->whereBetween('created_at', [$startOfLastYear, $endOfLastYear])
            ->get();

        return view('registerpage', [
            'registers' => $registers,
            'sort' => '5',
            'pdf' => '/registeredusers-lastyear',
        ]);
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
            'email' => 'required|string',
            'barangay' => 'required|string',
            'municipality' => 'required|string',
            'province' => 'required|string',
            'contactnumber' => 'required|numeric',
            'emergencynumber' => 'required|numeric',
            'medicalcondition' => 'nullable|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'vehiclelicense' => 'required|string',
            'color' => 'required|string',
            'type' => 'required|string',
            'gender' => 'required|string',
            'password' => ['required', 'confirmed',  \Illuminate\Validation\Rules\Password::defaults()],
           
        ]);

        try { 
        $register = Register::create($validatedData);
        $registerId = $register->id; 
        $user = User::create([
            'name' => $register->name,
            'email' => $register->email,
            'password' => Hash::make($request->password),
            'register_id' => $registerId,
        ]);

        // Assign the role 'driver' to the user
        $driverRole = Role::where('name', 'driver')->first();
        if ($driverRole) {
            $user->assignRole($driverRole);
        }

        $mailData = [
            'title' => 'Welcome to our platform!',
            'body' => 'Your account has been created successfully.',
            'name' => $request->name, // Pass name here
            'password' => $request->password, // Pass password here
        ];
     
             // Send email
             Mail::to($request->email)->send(new HelloMail($mailData));
     
           
     

        // Dispatch Registered event
        event(new Registered($user));

        
          
                 // Redirect back with success message
        return redirect()->back()->with('success', 'Owner information saved successfully.');
       
    
         } catch (ValidationException $e) {
             // If email validation fails due to uniqueness, show an alert
             return back()->withErrors(['email' => 'The email address already exists.'])->withInput();
         }
    
    
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $register = Register::findOrFail($id);
        return view('registerpage.view', compact('register'));
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
            'contactnumber' => 'required|numeric',
            'emergencynumber' => 'required|numeric',
            'medicalcondition' => 'nullable|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'vehiclelicense' => 'required|string',
            'color' => 'required|string',
            'type' => 'required|string',
            'gender' => 'required|string',
            

        ]);

        $registers = Register::findOrFail($id);
        $registers->update($request->all());

        return redirect()->back()->with('success', 'Owner information saved successfully.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the register by ID
        $register = Register::findOrFail($id);
        
        // Delete associated users where register_id matches
        User::where('register_id', $id)->delete();
        
        // Delete the register
        $register->delete();
    
        // Redirect with success message
        return redirect()->route('registerpage')->with('success', 'Register and associated users deleted successfully!');
    }





    public function getUserInfo(Request $request){

        $userID = $request->id;
        $key = $request->key;

        if($key == env('CRASHWATCH_KEY')){
            $user = Register::where('id', $userID)->first();

            if ($user) {
                return response()->json($user);
            }else{
                return null;
            }

        }else{
            return null;
        }

        
    }
}
