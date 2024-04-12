<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ReportpdfController;
use App\Http\Controllers\ChartDataController;
use App\Http\Controllers\barangayController;
use App\Http\Controllers\RegisteredUserReportController;
use App\Http\Controllers\BarangayReportController;
use App\Http\Controllers\ReportControllerAll;
use App\Http\Controllers\AllReportController;

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




Route::get('/chart', [ChartDataController::class, 'index']);

Route::get('/reporting', [ReportController::class, 'index'])->name('reporting.index');
Route::get('/reporting/{id}', [ReportController::class, 'show'])->name('reporting.view');
Route::post('/reporting/send', [ReportController::class, 'send'])->name('reporting.send');
Route::put('/reporting/{id}', [ReportController::class, 'update'])->name('reporting.update');
Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

Route::prefix('/')->group(function (){    
Route::post("/registerpage",[RegisterController::class, 'store'])->name('users.post');}); 
Route::get('/reports/{id}', [ReportpdfController::class, 'index'])->name('reports');

Route::get('/allreports', [ReportControllerAll::class, 'index'])->name('allreports');
Route::get('/barangayreports/{id}', [BarangayReportController::class, 'generateReport'])->name('barangayreport');
Route::get('/barangay', [barangayController::class, 'index'])->name('barangay');

// Register PDF
Route::get('/registeredusers', [RegisteredUserReportController::class, 'allTime'])->name('registeredReport');
Route::get('/registeredusers-thisweek', [RegisteredUserReportController::class, 'thisWeek'])->name('registeredusers-thisweek');
Route::get('/registeredusers-thismonth', [RegisteredUserReportController::class, 'thisMonth'])->name('registeredusers-thismonth');
Route::get('/registeredusers-lastmonth', [RegisteredUserReportController::class, 'lastMonth'])->name('registeredusers-lastmonth');
Route::get('/registeredusers-thisyear', [RegisteredUserReportController::class, 'thisYear'])->name('registeredusers-thisyear');
Route::get('/registeredusers-lastyear', [RegisteredUserReportController::class, 'lastYear'])->name('registeredusers-lastyear');

Route::get('/registerpage',[RegisterController::class, 'getRegisters'])->name('registerpage');
Route::get('registerpage/edit/{id}', 'App\Http\Controllers\RegisterController@edit')->name('registerpage.edit');
Route::put('/registerpage/{id}', [RegisterController::class, 'update'])->name('registerpage.update');
Route::delete('/registerpage/{id}', [RegisterController::class, 'destroy'])->name('registerpage.destroy'); 
Route::get('/registerpage/{id}', [RegisterController::class, 'show'])->name('registerpage.view');

Route::get('/dashboard', [DashboardController::class, 'recentRegisters'])->name('dashboard');

Route::get('/all-time-report-dashboard', [DashboardController::class, 'getAllTimeReports'])->name('all-time-report-dashboard');
Route::get('/this-week-report-dashboard', [DashboardController::class, 'getThisWeekReports'])->name('this-week-report-dashboard');
Route::get('/this-month-report-dashboard', [DashboardController::class, 'getThisMonthsReports'])->name('this-month-report-dashboard');
Route::get('/last-month-report-dashboard', [DashboardController::class, 'getLastMonthReports'])->name('last-month-report-dashboard');
Route::get('/this-year-report-dashboard', [DashboardController::class, 'getThisYearReports'])->name('this-year-report-dashboard');
Route::get('/last-year-report-dashboard', [DashboardController::class, 'getLastYearReports'])->name('last-year-report-dashboard');

Route::get('/this-week-register', [RegisterController::class, 'getThisWeekRegisters'])->name('this-week-register');
Route::get('/this-month-register', [RegisterController::class, 'getThisMonthRegisters'])->name('this-month-register');
Route::get('/last-month-register', [RegisterController::class, 'getLastMonthRegisters'])->name('last-month-register');
Route::get('/this-year-register', [RegisterController::class, 'getThisYearRegisters'])->name('this-year-register');
Route::get('/last-year-register', [RegisterController::class, 'getLastYearRegisters'])->name('last-year-register');

Route::get('/this-week-reports', [ReportController::class, 'getThisWeekReports'])->name('this-week-reports');
Route::get('/this-month-reports', [ReportController::class, 'getThisMonthReports'])->name('this-month-reports');
Route::get('/last-month-reports', [ReportController::class, 'getLastMonthReports'])->name('last-month-reports');
Route::get('/this-year-reports', [ReportController::class, 'getThisYearReports'])->name('this-year-reports');
Route::get('/last-year-reports', [ReportController::class, 'getLastYearReports'])->name('last-year-reports');


Route::get('/allreport', [AllReportController::class, 'allTime'])->name('allreport');
Route::get('/reports-thisweek', [AllReportController::class, 'thisWeek'])->name('reports-thisweek');
Route::get('/reports-thismonth', [AllReportController::class, 'thisMonth'])->name('reports-thismonth');
Route::get('/reports-lastmonth', [AllReportController::class, 'lastMonth'])->name('reports-lastmonth');
Route::get('/reports-thisyear', [AllReportController::class, 'thisYear'])->name('reports-thisyear');
Route::get('/reports-lastyear', [AllReportController::class, 'lastYear'])->name('reports-lastyear');

});
require __DIR__.'/auth.php';