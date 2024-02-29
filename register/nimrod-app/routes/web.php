<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/reporting', function () {
    return view('reporting');  
}); 


Route::prefix('reporting')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});

Route::prefix('/')->group(function (){
    
    Route::post("/registerpage",[RegisterController::class, 'store'])->name('users.post');   
   
}); 

});

Route::get('/registerpage', function () {
    $registers = DB::table('registers')->get();
    return view('registerpage', [
        'registers' => $registers
    ]);
})->name('registerpage');




require __DIR__.'/auth.php';
