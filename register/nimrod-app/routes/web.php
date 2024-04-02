<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\DB;
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

Route::post('/post_report', [ReportController::class, 'store'])->name('reporting.post');

Route::post('/accident',[RegisterController::class, 'getUserInfo']);
Route::post('/location',[MapController::class, 'getMap']);

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

Route::get('/reporting', [ReportController::class, 'index'])->name('reporting.index');
Route::get('/reporting/{id}', [ReportController::class, 'show'])->name('reporting.view');
Route::post('/reporting/send', [ReportController::class, 'send'])->name('reporting.send');

Route::prefix('/')->group(function (){
    
    Route::post("/registerpage",[RegisterController::class, 'store'])->name('users.post');   
   
}); 

Route::get('/registerpage',[RegisterController::class, 'getRegisters'])->name('registerpage');
Route::get('registerpage/edit/{id}', 'App\Http\Controllers\RegisterController@edit')->name('registerpage.edit');
Route::put('/registerpage/{id}', [RegisterController::class, 'update'])->name('registerpage.update');
Route::delete('/registerpage/{id}', [RegisterController::class, 'destroy'])->name('registerpage.destroy'); 
Route::get('/registerpage/{id}', [RegisterController::class, 'show'])->name('registerpage.view');


Route::get('/dashboard', [DashboardController::class, 'recentRegisters'])->name('dashboard');

});





 

require __DIR__.'/auth.php';
