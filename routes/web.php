<?php

use App\Http\Controllers\AdminRequestsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AutomaticSqueezeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CalibersController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseCarController;
use App\Http\Controllers\FillController;
use App\Http\Controllers\FillingAdminRequestsController;
use App\Http\Controllers\FillingByOriginalStoreController;
use App\Http\Controllers\FillingRequestsController;
use App\Http\Controllers\ForfeitLeaveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntroductionSheetController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LabsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\OriginalStockController;
use App\Http\Controllers\OriginalStoreWorkerController;
use App\Http\Controllers\PlanningCarController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\PressingRequestController;
use App\Http\Controllers\ProductionInvoicesController;
use App\Http\Controllers\RecieveOriginalStockFromSupplierController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SqueezeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\TyingBalesController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\VacationTypeController;
use App\Http\Controllers\WageController;
use App\Models\IntroductionSheet;
use App\Models\OriginalStock;
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
    Route::get('cars/change-status/{id}', [CarsController::class, 'changeStatus']);
    Route::get('cars/get-places/{process}', [CarsController::class, 'getPlaces']);
    Route::get('cars/get-barcode/{id}', [CarsController::class, 'getBarcode']);
    Route::resource('cars',CarsController::class);
    // ++++++++++ introduction_sheet ++++++++++
    Route::resource('introduction-sheet',IntroductionSheetController::class);
    // ++++++++++ Create Page : Add "new row" ++++++++++
    Route::get('introduction-sheet/get-sheet-row/{row_index}', [IntroductionSheetController::class , 'getSheetRow']);
    //++++++++++ fetch "processes" of selected "process_type" selectbox ++++++++++
    Route::post('fetch-processes',[IntroductionSheetController::class,'fetchProcesses']);
    // +++++++ print "introduction_sheet" ++++++++++
    Route::get('print/invoice/{id}',[IntroductionSheetController::class, 'print'])->name('print_invoice');
    // +++++++ print "barcode" ++++++++++
    Route::get('print/barcode/{id}',[IntroductionSheetController::class, 'printBarcode'])->name('print_barcode');


    Route::resource('maintain-car',ExpenseCarController::class);
    Route::post('change-cart-plan',[PlanningCarController::class,'changeCartPlan']);
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
    Route::get('customer/customer_dues/{id}', [CustomerController::class,'customer_dues'])->name('customer_dues');
    Route::post('customers/add-balance',[CustomerController::class,'addBalance'])->name('customers.add-balance');
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
    Route::get('original-store-worker/add-nationality-row', [OriginalStoreWorkerController::class,'addNationalityRow']);
    Route::resource('original-store-worker',OriginalStoreWorkerController::class);
    Route::resource('recieve-shipment-from-supplier',RecieveOriginalStockFromSupplierController::class);
    Route::get('get-cart-weight', [FillingByOriginalStoreController::class,'getCartWeight']);
    Route::resource('original-store-worker-filling',FillingByOriginalStoreController::class);
    Route::resource('admin_opening_request',AdminRequestsController::class);
    Route::get('get-nationality-weight/{id}',[ AdminRequestsController::class,'getWeight']);
    Route::get('add-nationality-row', [AdminRequestsController::class,'addNationalityRow']);
    Route::get('add-filling-row', [FillingRequestsController::class,'addFiliingRow']);
    Route::resource('admin_filling_request',FillingRequestsController::class);

    Route::get('filling-admin-requests/add-nationality-row', [FillingAdminRequestsController::class,'addNationalityRow']);
    Route::resource('filling-admin-requests',FillingAdminRequestsController::class);
    Route::resource('transporter',TransporterController::class);
    Route::resource('squeeze',SqueezeController::class);
    Route::get('print-bale-staker/{bale_id}',[SqueezeController::class,'printBaleStaker']);
    Route::resource('tying-bales',TyingBalesController::class);
    Route::resource('automatic-squeeze',AutomaticSqueezeController::class);
    // +++++++++++++++++++++++++++ Production Routes +++++++++++++++++++++++++++
    Route::resource('production',ProductionController::class);
    Route::post('production/invoice',[ProductionController::class,'invoice'])->name('production.invoice');
    Route::post('production/invoice/store_invoice',[ProductionController::class,'store_invoice'])->name('production.invoice.store_invoice');
    // update "update_customer_balance"
    Route::post('production/invoice/store_invoice/update-customer-balance',[ProductionController::class,'update_customer_balance'])
            ->name('production.invoice.store_invoice.update_customer_balance');
    // Get Data of "Selected Customer" From customers selectbox
    Route::post('production/invoice/getCustomerInfo/',[ProductionController::class,'getCustomerInfo'])->name('production.invoice.getCustomerInfo');
    // ++++++++++++++ Customer Dues ++++++++++++++
    Route::get('customer/customer_dues/{id}', [CustomerController::class,'customer_dues'])->name('customer_dues');
    Route::post('customer/pay_due/', [CustomerController::class,'pay_due'])->name('customers.pay_due');
    Route::get('pay_due_view/{id}', [CustomerController::class,'pay_due_view'])->name('customers.pay_due_view');
    // +++++++++++++++++++++++++++ Production_Invoices Routes +++++++++++++++++++++++++++
    Route::resource('production_invoices',ProductionInvoicesController::class);
    // -------- Invoices Dues --------
    Route::post('production_invoices/pay_due/', [ProductionInvoicesController::class,'pay_due'])->name('production_invoices.pay_due');
    Route::get('production_invoices/pay_due_view/{id}', [ProductionInvoicesController::class,'pay_due_view'])->name('production_invoices.pay_due_view');

    Route::resource('pressing-admin-requests',PressingRequestController::class);
    Route::get('add-pressing-row', [PressingRequestController::class,'addPressingRow']);
    Route::resource('lab',LabsController::class);
    Route::resource('calibers',CalibersController::class);
    Route::get('original-stock-create',[OriginalStockController::class,'create'])->name('original-stock-create');
});
Auth::routes();

