<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Wage;
use App\Models\WageTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Utils\Util;

class WageController extends Controller
{
    protected $Util;

    /**
     * Constructor
     *
     * @param Utils $product
     * @return void
     */
    public function __construct(Util $Util)
    {
        $this->Util = $Util;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('employees_module.wages.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $wages=Wage::latest()->get();
        $payment_types = Wage::getPaymentTypes();
        return view('employees.wages.index',compact('wages','payment_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->can('employees_module.wages.create')){
            abort(403, __('lang.unauthorized_action'));
        }
        $employees = Employee::latest()->pluck('name','id');
        $payment_types = Wage::getPaymentTypes();
        $users = User::Notview()->pluck('name', 'id');
        return view('employees.wages.create',compact('employees','payment_types','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', 'submit');
            $data['net_amount'] = (float)($data['net_amount']);
            $data['date_of_creation'] = Carbon::now();
            $data['created_by'] = Auth::user()->id;
            $data['status'] = $request->submit == 'Paid' ? 'paid' : 'pending';
            $data['payment_date'] = !empty($data['payment_date']) ? $this->Util->uf_date($data['payment_date']) : null;
            $data['acount_period_start_date'] = !empty($data['acount_period_start_date']) ? $this->Util->uf_date($data['acount_period_start_date']) : null;
            $data['acount_period_end_date'] = !empty($data['acount_period_end_date']) ? $this->Util->uf_date($data['acount_period_end_date']) : null;

            $wage=Wage::create($data);


            $employee = Employee::find($wage->employee_id);
            $transaction_data = [
                'type' => 'wage',
                'store_id' => !empty($employee->store_id) ? $employee->store_id[0] : null,
                'employee_id' => $wage->employee_id,
                'transaction_date' => Carbon::now(),
                'grand_total' => $this->Util->num_uf($data['net_amount']),
                'final_total' => $this->Util->num_uf($data['net_amount']),
                'status' => 'final',
                'payment_status' => $data['status'],
                'wage_id' => $wage->id,
                'source_type' => $request->source_type,
                'source_id' => $request->source_id,
                'created_by' => Auth::user()->id,
            ];

            $transaction = WageTransaction::create($transaction_data);
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
    
        return redirect()->back()->with('status', $output);
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
        if(!auth()->user()->can('employees_module.wages.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        $employees = Employee::latest()->pluck('name','id');
        $payment_types = Wage::getPaymentTypes();
        $users = User::Notview()->pluck('name', 'id');
        $wage=Wage::find($id);
        return view('employees.wages.edit',compact('employees','payment_types','users','wage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token', 'submit', '_method');
            $data['edited_by'] = Auth::user()->id;
            $data['net_amount'] = $data['net_amount'];
            $data['other_payment'] = !empty($data['other_payment']) ? $data['other_payment'] : 0;
            $data['deductibles'] = !empty($data['deductibles']) ? $this->Util->num_uf($data['deductibles']) : 0;
            $data['payment_date'] = !empty($data['payment_date']) ? $this->Util->uf_date($data['payment_date']) : null;
            $data['source_id'] = !empty($data['source_id']) ? $data['source_id'] : null;
            $data['source_type'] = !empty($data['source_type']) ? $data['source_type'] : null;
            $data['acount_period_start_date'] = !empty($data['acount_period_start_date']) ? $this->Util->uf_date($data['acount_period_start_date']) : null;
            $data['acount_period_end_date'] = !empty($data['acount_period_end_date']) ? $this->Util->uf_date($data['acount_period_end_date']) : null;
            $wage = Wage::find($id);
            $wage->update($data);


            $transaction = WageTransaction::where('wage_id', $id)->first();

            $transaction_data = [
                'grand_total' => $this->Util->num_uf($data['net_amount']),
                'final_total' => $this->Util->num_uf($data['net_amount']),
                'status' => 'final',
                'payment_status' => $wage->status,
                'wage_id' => $wage->id,
                'source_type' => $request->source_type,
                'source_id' => $request->source_id,
                'edited_by' => Auth::user()->id,
            ];

            if (!empty($transaction)) {
                $transaction->update($transaction_data);
            } else {
                $transaction_data['type'] = 'wage';
                $transaction_data['transaction_date'] = $wage->date_of_creation;
                $transaction = WageTransaction::create($transaction_data);
            }
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
    
        return redirect()->back()->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->can('employees_module.wages.delete')){
            abort(403, __('lang.unauthorized_action'));
        }
        try{
            $wage=Wage::find($id);
            $wage->deleted_by=Auth::user()->id;
            $wage_transaction=WageTransaction::where('wage_id',$id)->first();
            $wage_transaction->deleted_by=Auth::user()->id;
            $wage->save();
            $wage_transaction->save();
            $wage->delete();
            $wage_transaction->delete();
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
    public function calculateSalaryAndCommission($employee_id, $payment_type)
    {
        // return $employee_id;
        $employee = Employee::find($employee_id);
        $user_id = $employee->user_id;
        $amount = 0;

        if ($payment_type == 'salary') {
            if ($employee->fixed_wage == 1) {
                $fixed_wage_value = $employee->fixed_wage_value;
                $payment_cycle = $employee->payment_cycle;

                if ($payment_cycle == 'daily') {
                    $amount = $fixed_wage_value * 30;
                }
                if ($payment_cycle == 'weekly') {
                    $amount = $fixed_wage_value * 4;
                }
                if ($payment_cycle == 'bi-weekly') {
                    $amount = $fixed_wage_value * 2;
                }
                if ($payment_cycle == 'monthly') {
                    $amount = $fixed_wage_value * 1;
                }
            }
        }

        if ($payment_type == 'commission') {
            $start_date = request()->acount_period_start_date;
            $end_date = request()->acount_period_end_date;

            $amount = $this->Util->calculateEmployeeCommission($employee_id, $start_date, $end_date);
        }

        return ['amount' => $this->Util->num_f($amount)];
    }
    public function changeWageStatus($wage_id){

        if(!auth()->user()->can('employees_module.wages.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        try {
            $wages = Wage::find($wage_id);
            $wages->status = 'paid';
            $wages->save();

            $output = [
                'success' => true,
                'msg' => __('lang.status_updated')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return redirect()->back()->with('status', $output);
    }
}
