<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CalibersController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseCarController;
use App\Http\Controllers\FillController;
use App\Http\Controllers\ForfeitLeaveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LabsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\PlanningCarController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\VacationTypeController;
use App\Http\Controllers\WageController;
use App\Models\Screening;
use Illuminate\Support\Facades\Route;

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
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
});
// Route::get('/', [HomeController::class,'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('user/check-password', [HomeController::class, 'checkPassword']);
    Route::resource('nationality',NationalityController::class);
    Route::resource('cars',CarsController::class);
    Route::resource('maintain-car',ExpenseCarController::class);
    Route::resource('planning-carts',PlanningCarController::class);
    Route::resource('opening',OpeningController::class);
    Route::resource('types',TypeController::class);
    Route::resource('colors',ColorController::class);
    Route::resource('fills',FillController::class);
    Route::resource('screening',ScreeningController::class);
    Route::resource('branches',BranchController::class);
    Route::resource('stores',StoreController::class);
    Route::resource('suppliers',SupplierController::class);
    Route::resource('customers',CustomerController::class);
    Route::resource('employees',EmployeeController::class);
    Route::resource('jobs',JobController::class);
    Route::resource('leave_types',VacationTypeController::class);
    Route::get('wages/calculate-salary-and-commission/{employee_id}/{payment_type}', [WageController::class,'calculateSalaryAndCommission']);
    Route::get('wages/change-wage-status/{wage_id}', [WageController::class,'changeWageStatus'])->name('wages.changeWageStatus');
    Route::resource('wages',WageController::class);
    Route::get('attendance/get-attendance-row/{row_index}', [AttendanceController::class,'getAttendanceRow']);
    Route::resource('attendance',AttendanceController::class);
    Route::resource('leaves',LeaveController::class);
    Route::resource('forfeit-leaves',ForfeitLeaveController::class);
    Route::post('settings/update-general-settings', [SettingController::class, 'updateGeneralSetting'])->name('settings.updateGeneralSettings');
    Route::post('settings/remove-image/{type}', [SettingController::class,'removeImage']);
    Route::resource('settings',SettingController::class);
    
    
    Route::resource('lab',LabsController::class);
    Route::resource('calibers',CalibersController::class);
});
Auth::routes();

