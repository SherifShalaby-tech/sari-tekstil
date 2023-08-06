<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FillController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeController;
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
    Route::resource('types',TypeController::class);
    Route::resource('colors',ColorController::class);
    Route::resource('fills',FillController::class);
    Route::resource('suppliers',SupplierController::class);
    Route::resource('customers',CustomerController::class);

});
Auth::routes();

