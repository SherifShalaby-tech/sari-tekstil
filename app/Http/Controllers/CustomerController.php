<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ProductionTransaction;
use App\Models\ProductionTransactionPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('customers_module.customer.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $customers=Customer::latest()->get();
        // dd($customers);
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->can('customers_module.customer.create')){
            abort(403, __('lang.unauthorized_action'));
        }
        $users=User::orderBy('created_at', 'desc')->pluck('name','id');
        return view('customers.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'max:255|required',
        ]);
        try {
            $data = $request->except('_token');
            $data['created_by'] = Auth::user()->id;
            Customer::create($data);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];

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
        if(!auth()->user()->can('customers_module.customer.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        $users=User::orderBy('created_at', 'desc')->pluck('name','id');
        $customer=Customer::find($id);
        return view('customers.edit',compact('users','customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->except('_token');
            $data['name'] = $request->name;
            $data['edited_by'] = Auth::user()->id;
            Customer::find($id)->update($data);
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
        if(!auth()->user()->can('customers_module.customer.delete')){
            abort(403, __('lang.unauthorized_action'));
        }
        try {
            $customer=Customer::find($id);
            $customer->deleted_by=Auth::user()->id;
            $customer->save();
            $customer->delete();
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
    public function addBalance(string $id){

    }
    // ++++++++++++++++ customer_dues() : Get Partial Paid Invoices ++++++++++++++++
    public function customer_dues($id,Request $request)
    {
        $dues = ProductionTransaction::where('customer_id', $id)
                                    ->where('payment_status', '!=', 'paid')
                                    ->where('status','!=','final')->get();
        // Now you can use $dues to access the results
        // dd($dues);

        return view('customers.due', compact('dues'));
    }
    // ++++++++++++++++ pay_due_view() : Get Partial Paid Invoices ++++++++++++++++
    public function pay_due_view($id)
    {
        // if(!$request->date){
        $due = ProductionTransaction::where('id',$id)->first();
        $total_amount = $due->grand_total;
        $customer_paid = floatval($due->transaction_payments->sum('customer_paid'));
        $dueAmount =  $total_amount - $customer_paid;
        // dd($dueAmount);
        // Return the dueAmount as a JSON response
        return response()->json(['dueAmount' => $dueAmount , "customer_paid"=>$customer_paid ,'customer_id' => $due->customer_id]);
        // return view('customers.due_modal')->with(compact('dueAmount','due'));
    }
    // ++++++++++++++++ pay_due() : Get Partial Paid Invoices ++++++++++++++++
    public function pay_due(Request $request)
    {
        // dd($request);
        // dd($request->production_transaction_id);
        try
        {
            $due_transaction = ProductionTransaction::where('id',$request->production_transaction_id)->first();
            $due_payment     = ProductionTransactionPayment::where('production_transaction_id',$request->production_transaction_id)->first();
            // old "final_total" from "DB"
            $old_final_total = $due_transaction->final_total;
            // $new_final_total = $request->customer_paid + $old_final_total
            $new_final_total = $request->customer_paid + $old_final_total;
            // total customer paid
            $total_customer_paid = $request->customer_paid + $new_final_total;
            // Create "new payment"
            // dd( $total_customer_paid - $due_transaction->grand_total );
            $payment_data =
            [
                'production_transaction_id' => $due_transaction->id,
                'customer_id' => $due_payment->customer_id,
                'amount' => $due_payment->amount,
                'customer_rest' => $total_customer_paid - $due_transaction->grand_total,
                'sum_total_cost' => $due_payment->sum_total_cost,
                'payment_type' => 'cash',
                'payment_date' => date('Y-m-d'),
                'created_by' => auth()->user()->id
            ];
            // =============== if "customer_paid" < "dueAmount" ===============
            if( $request->customer_paid < $request->dueAmount )
            {
                // "prod_transaction_payments" table   : Update "customer_paid" in DB
                // $due_payment->update(['customer_paid' => $new_customer_paid]);
                $payment_data['customer_paid'] = $request->customer_paid;
                // "production_transactions" table : Update "final_total" in DB
                $due_transaction->update(['final_total' => $new_final_total ]);
            }
            // =============== if "customer_paid" == "dueAmount" ===============
            elseif( $request->customer_paid == $request->dueAmount )
            {
                // "prod_transaction_payments" table   : Update "customer_paid" in DB
                // $due_payment->update(['customer_paid' => $new_customer_paid ,'customer_rest' => '0' ,'payment_status'=>'paid']);
                $payment_data['customer_paid'] = $request->customer_paid;
                // "production_transactions" table : Update "final_total" in DB
                $due_transaction->update(['final_total' => $due_transaction->grand_total ,'status' => 'final' ,'payment_status'=>'paid']);
            }
            // =============== if "customer_paid" > "dueAmount" ===============
            else
            {
                // customer_rest : المتبقي للعميل
                $customer_rest = $request->rest_paid;
                // Update "customer_paid" in DB
                $payment_data['customer_paid'] = $request->customer_paid-$customer_rest;
                // add "rest" to customer "balance" in customers table in DB
                if( $request->balance > 0 && $request->balance != null )
                {
                    if ($request->customer_id)
                    {
                        // Get customer data
                        $customer = Customer::find($request->customer_id);
                        // Add the new balance to the existing balance
                        $new_balance = $customer->balance + $request->balance;
                        // Update the customer balance
                        $customer->update(['balance' => $new_balance]);
                    }
                }
                // add "rest" to "customer_rest" in "prod_transaction_payments" table in DB
                else
                {
                    $payment_data['customer_rest'] = $customer_rest;
                }
                $due_transaction->update(['final_total' => $due_transaction->grand_total ,'status' => 'final' ,'payment_status'=>'paid']);
            }
            // Create a new "production_transaction_payment"
            ProductionTransactionPayment::create($payment_data);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        }
        catch (\Exception $e)
        {
            dd($e);
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }
        return redirect()->back()->with('status', $output);
    }
}
