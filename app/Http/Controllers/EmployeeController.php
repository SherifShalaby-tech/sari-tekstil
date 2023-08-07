<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees=Employee::latest()->get();
        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::orderBy('created_at', 'desc')->pluck('name','id');
        $payment_cycle = Employee::paymentCycle();
        $commission_type = Employee::commissionType();
        $commission_calculation_period = Employee::commissionCalculationPeriod();
        $modulePermissionArray = User::modulePermissionArray();
        $subModulePermissionArray = User::subModulePermissionArray();
        $week_days =  Employee::getWeekDays();
        $cashiers = Employee::getDropdownByJobType('Cashier');
        $leave_types = LeaveType::all();
        return view('employees.create',
        compact('users','payment_cycle','commission_type','commission_calculation_period',
        'modulePermissionArray','subModulePermissionArray','week_days','cashiers','leave_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users|max:255',
            'name' => 'required|max:255',
            'password' => 'required|confirmed|max:255',
        ]);
  
        // try {
            $data = $request->except('_token');
            $data['fixed_wage'] = !empty($data['fixed_wage']) ? 1 : 0;
            $data['commission'] = !empty($data['commission']) ? 1 : 0;
  
            $user_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
  
            ];
            $user = User::create($user_data);
  
            // $employee = new Employee();
            // $employee->employee_name = $data['name'];
            // $employee->user_id = $user->id;
            $data['password'] = Crypt::encrypt($data['password']);
            // $employee->date_of_start_working = $data['date_of_start_working'];
            // $employee->date_of_birth = $data['date_of_birth'];
            // $employee->job_type_id = $data['job_type_id'];
            // $employee->mobile = $data['mobile'];
            // $employee->annual_leave_per_year = !empty($data['annual_leave_per_year']) ?  $data['annual_leave_per_year'] : 0;
            // $employee->number_of_days_any_leave_added = !empty($data['number_of_days_any_leave_added']) ?  $data['number_of_days_any_leave_added'] : 0;
            // $employee->working_day_per_week =json_encode(!empty($data['working_day_per_week']) ?  $data['working_day_per_week'] : []) ;
            // $employee->check_in =json_encode(!empty($data['check_in']) ?  $data['check_in'] : []) ;
            // $employee->check_out = json_encode(!empty($data['check_out']) ?  $data['check_out'] : []);
            // $employee->fixed_wage = $data['fixed_wage'];
            // $employee->fixed_wage_value = $data['fixed_wage_value'] ?? 0;
            // $employee->payment_cycle = $data['payment_cycle'];
            // $employee->commission = $data['commission'];
            // $employee->commission_value = $data['commission_value']?? 0;
            // $employee->commission_type = $data['commission_type'];
            // $employee->commision_calculation_period = $data['commission_calculation_period'];
            $data['commissioned_products'] = json_encode(!empty($data['commissioned_products']) ? $data['commissioned_products'] : []);
            $data['commission_customer_types'] = json_encode(!empty($data['commission_customer_types']) ? $data['commission_customer_types'] : []);
            $data['commission_stores'] = json_encode(!empty($data['commission_stores']) ? $data['commission_stores'] : []);
            $data['commission_cashiers'] = json_encode(!empty($data['commission_cashiers']) ? $data['commission_cashiers'] : []);
            // if ($request->hasFile('photo')) {
            //     $employee->photo = store_file($request->file('photo'), 'employees');
            // }
            // $employee->save();
            // $employee->stores()->sync($data['store_id']);
            $user->employees->create($data);
  
  
          //   if ($request->hasFile('upload_files')) {
          //       foreach ($request->file('upload_files') as $file) {
          //           $employee->addMedia($file)->toMediaCollection('employee_files');
          //       }
          //   }
  
            //add of update number of leaves
            // $this->createOrUpdateNumberofLeaves($request, $employee->id);
  
            //assign permissions to employee
  //          if (!empty($data['permissions'])) {
  //              $user->syncPermissions($data['permissions']);
  //          }
  
        //     $output = [
        //         'success' => true,
        //         'msg' => __('lang.employee_added')
        //     ];
  
        //     return redirect()->route('employees.index')->with('status', $output);
        // }
        // catch (\Exception $e) {
        //     Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
        //     $output = [
        //         'success' => false,
        //         'msg' => __('lang.something_went_wrong')
        //     ];
        // }
        //     return redirect()->back()->with('status', $output);
  
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
