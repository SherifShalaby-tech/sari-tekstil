<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Job;
use App\Models\LeaveType;
use App\Models\NumberOfLeave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('employees_module.employee.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $employees=Employee::latest()->get();
        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->can('employees_module.employee.create')){
            abort(403, __('lang.unauthorized_action'));
        }
        $jobs=Job::orderBy('created_at', 'desc')->pluck('title','id');
        $payment_cycle = Employee::paymentCycle();
        $commission_type = Employee::commissionType();
        $commission_calculation_period = Employee::commissionCalculationPeriod();
        $modulePermissionArray = User::modulePermissionArray();
        $subModulePermissionArray = User::subModulePermissionArray();
        $week_days =  Employee::getWeekDays();
        $cashiers = Employee::getDropdownByJobType('Cashier');
        $leave_types = LeaveType::all();
        $branches=Branch::orderBy('created_at', 'desc')->pluck('name','id');
        return view('employees.create',
        compact('jobs','payment_cycle','commission_type','commission_calculation_period',
        'modulePermissionArray','subModulePermissionArray','week_days','cashiers','leave_types','branches'));
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
  
        try {
            $data = $request->except('_token');
         
            $data['fixed_wage'] = !empty($data['fixed_wage']) ? 1 : 0;
            $data['commission'] = !empty($data['commission']) ? 1 : 0;
  
            $user_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];
            $user = User::create($user_data);
            $job=Job::find($request->job_type_id);
            // $user->assignRole($job->title);
            $data['user_id'] = $user->id;
            $data['password'] = $data['password'];
            $data['fixed_wage_value'] = $data['fixed_wage_value'] ?? 0;
            $data['payment_cycle'] = $data['payment_cycle'];
            $data['annual_leave_per_year'] = !empty($data['annual_leave_per_year']) ?  $data['annual_leave_per_year'] : 0;
            $data['number_of_days_any_leave_added'] = !empty($data['number_of_days_any_leave_added']) ?  $data['number_of_days_any_leave_added'] : 0;
            $data['working_day_per_week'] =!empty($data['working_day_per_week']) ?  $data['working_day_per_week'] : [] ;
            $data['commission_value'] = $data['commission_value']?? 0;
            $data['commission_customer_types'] = !empty($data['commission_customer_types']) ? $data['commission_customer_types'] : [];
            // $data['commission_stores'] = !empty($data['commission_stores']) ? $data['commission_stores'] : [];
            $data['comission_cashier'] = !empty($data['comission_cashier']) ? $data['comission_cashier'] : [];
             $data['check_in'] =!empty($data['check_in']) ?  $data['check_in'] : [];
             $data['check_out'] = !empty($data['check_out']) ?  $data['check_out'] : [];
            if ($request->hasFile('photo')) {
                $image= $request->file('photo');
                $ext = $image->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $image->move("uploads/employees/", $filename);
                $data['photo']=$filename;
            }
            if ($request->hasFile('upload_files')) {
                $files=[];
                for ($i=0;$i<count($request->upload_files);$i++) {
                    $image= $request->upload_files[$i];
                    $ext = $image->getClientOriginalExtension();
                    $filename = rand(1111,9999).time() . '.' . $ext;
                    $image->move("uploads/employees/", $filename);
                    $files[]= $filename;
                }
                $data['files']=$files;
            }
            $data['created_by']=Auth::user()->id;
            // $employee->stores()->sync($data['store_id']);
            $employee=Employee::create($data);
  
            //add of update number of leaves
            $this->createOrUpdateNumberofLeaves($request, $employee->id);
  
            //assign permissions to employee
            if (!empty($request->permissions)) {
                foreach ($request->permissions as $key => $value) {
                    $permissions[] = $key;
                } 
            }
            if(!empty($job)){
                $permissions[]=$job->title;
                if (!empty($permissions)) {
                    $user->syncPermissions($permissions);
                }
            }
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
  
            return redirect()->route('employees.index')->with('status', $output);
        }
        catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }
        return redirect()->back()->with('status', $output);
  
    }
    public function createOrUpdateNumberofLeaves($request, $employee_id)
    {
        if (!empty($request->number_of_leaves)) {
            foreach ($request->number_of_leaves as $key => $value) {
                NumberOfLeave::updateOrCreate(
                    ['employee_id' => $employee_id, 'leave_type_id' => $key],
                    ['number_of_days' => $value['number_of_days'], 'created_by' => Auth::user()->id, 'enabled' => !empty($value['enabled']) ? 1 : 0]
                );
            }
        }
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
        if(!auth()->user()->can('employees_module.employee.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        $jobs= Job::orderBy('created_at', 'desc')->pluck('title','id');
        $payment_cycle = Employee::paymentCycle();
        $commission_type = Employee::commissionType();
        $commission_calculation_period = Employee::commissionCalculationPeriod();
        $modulePermissionArray = User::modulePermissionArray();
        $subModulePermissionArray = User::subModulePermissionArray();
        $week_days =  Employee::getWeekDays();
        $cashiers = Employee::getDropdownByJobType('Cashier');
        $leave_types = LeaveType::all();
        $branches=Branch::orderBy('created_at', 'desc')->pluck('name','id');
        $employee=Employee::find($id);
        $user = User::find($employee->user_id);
        return view('employees.edit',
        compact('employee','user','jobs','payment_cycle','commission_type','commission_calculation_period',
        'modulePermissionArray','subModulePermissionArray','week_days','cashiers','leave_types','branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'name' => 'required|max:255',
            'password' => 'required|confirmed|max:255',
        ]);
  
        try {
            $data = $request->except('_token');
         
            $data['fixed_wage'] = !empty($data['fixed_wage']) ? 1 : 0;
            $data['commission'] = !empty($data['commission']) ? 1 : 0;
  
            $user_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
  
            ];
            $user = User::find($request->user_id);
            $user->update($user_data);
            $employee=Employee::find($id);
            $job=Job::find($request->job_type_id);
            // $user->assignRole('Administrator');
            $data['user_id'] = $user->id;
            $data['password'] = $data['password'];
            $data['fixed_wage_value'] = $data['fixed_wage_value'] ?? 0;
            $data['payment_cycle'] = $data['payment_cycle'];
            $data['annual_leave_per_year'] = !empty($data['annual_leave_per_year']) ?  $data['annual_leave_per_year'] : 0;
            $data['number_of_days_any_leave_added'] = !empty($data['number_of_days_any_leave_added']) ?  $data['number_of_days_any_leave_added'] : 0;
            $data['working_day_per_week'] =!empty($data['working_day_per_week']) ?  $data['working_day_per_week'] : [] ;
            $data['commission_value'] = $data['commission_value']?? 0;
            $data['commission_customer_types'] = !empty($data['commission_customer_types']) ? $data['commission_customer_types'] : [];
            // $data['commission_stores'] = !empty($data['commission_stores']) ? $data['commission_stores'] : [];
            $data['comission_cashier'] = !empty($data['comission_cashier']) ? $data['comission_cashier'] : [];
             $data['check_in'] =!empty($data['check_in']) ?  $data['check_in'] : [];
             $data['check_out'] = !empty($data['check_out']) ?  $data['check_out'] : [];
            if ($request->hasFile('photo')) {
                if ($employee->photo) {
                    $fullPath = public_path('uploads/employees/' . $employee->photo);
                    File::delete($fullPath);
                }
                $image= $request->file('photo');
                $ext = $image->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $image->move("uploads/employees/", $filename);
                $data['photo']=$filename;
            }
            if ($request->hasFile('upload_files')) {
                if(!empty($employee->files)){
                    for ($i=0;$i<count($employee->files);$i++) {
                        $image= $employee->files[$i];
                        $fullPath = public_path('uploads/employees/' .$image);
                        File::delete($fullPath);
                    }
                }
                $files=[];
                for ($i=0;$i<count($request->upload_files);$i++) {
                    $image= $request->upload_files[$i];
                    $ext = $image->getClientOriginalExtension();
                    $filename = rand(1111,9999).time() . '.' . $ext;
                    $image->move("uploads/employees/", $filename);
                    $files[]= $filename;
                }
                $data['files']=$files;
            }
            $data['edited_by']=Auth::user()->id;
            // $employee->stores()->sync($data['store_id']);
       
            $employee->update($data);
  
            //add of update number of leaves
            $this->createOrUpdateNumberofLeaves($request, $employee->id);
  
            //assign permissions to employee
            if (!empty($request->permissions)) {
                foreach ($request->permissions as $key => $value) {
                    $permissions[] = $key;
                } 
            }
            if(!empty($job)){
                $permissions[]=$job->title;
                if (!empty($permissions)) {
                    $user->syncPermissions($permissions);
                }
            }

            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
            return redirect()->route('employees.index')->with('status', $output);;
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
            return redirect()->back()->with('status', $output);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->can('employees_module.employee.delete')){
            abort(403, __('lang.unauthorized_action'));
        }
        try {
            $employee=Employee::find($id);
            $user=User::find($employee->user_id)->delete();
            $employee->deleted_by=Auth::user()->id;
            if ($employee->photo) {
                $fullPath = public_path('uploads/employees/' . $employee->photo);
                File::delete($fullPath);
            }
            if(!empty($employee->files)){
                for ($i=0;$i<count($employee->files);$i++) {
                    $image= $employee->files[$i];
                    $fullPath = public_path('uploads/employees/' .$image);
                    File::delete($fullPath);
                }
            }
            $employee->save();
            $employee->delete();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
          } catch (\Exception $e) {
              Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
              $output = [
                  'success' => false,
                  'msg' => __('lang.something_went_wrong')
              ];
          }
          return $output;
    }
}
