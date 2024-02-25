<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ProductionInvoices;
use Illuminate\Support\Facades\Log;
use App\Models\ProductionTransaction;
use App\Models\ProductionTransactionPayment;

class ProductionInvoicesController extends Controller
{
    /* ++++++++++++++++++++++++++++ index() ++++++++++++++++++++++++++++ */
    public function index()
    {
        $productionInvoices =  ProductionTransaction::with('transaction_payments')->get();
        // dd($productionInvoices);
        return view('production.production_invoices.index',compact('productionInvoices'));
    }
    // ++++++++++++++++ pay_due_view() : Get "modal" data : Get Partial Paid Invoices ++++++++++++++++
    public function pay_due_view($id)
    {
        // if(!$request->date){
        $due = ProductionTransaction::where('id',$id)->first();
        $total_amount = $due->grand_total;
        $customer_paid = floatval($due->transaction_payments->sum('customer_paid'));
        $dueAmount =  $total_amount - $customer_paid;
        return response()->json(['dueAmount' => $dueAmount , "customer_paid"=>$customer_paid ,'customer_id' => $due->customer_id]);
        // return view('customers.due_modal')->with(compact('dueAmount','due'));
    }
    // ++++++++++++++++ pay_due() : Get Partial Paid Invoices ++++++++++++++++
    public function pay_due(Request $request)
    {
        // dd($request);
        // dd($request->production_transaction_id);
        $due_payment     = ProductionTransactionPayment::where('production_transaction_id',$request->production_transaction_id)->first();
        // dd($due_payment);
        try
        {
            $due_transaction = ProductionTransaction::where('id',$request->production_transaction_id)->first();
            $due_payment     = ProductionTransactionPayment::where('production_transaction_id',$request->production_transaction_id)->first();
            // dd($due_payment);
            // old "final_total" from "DB"
            $old_final_total = $due_transaction->final_total;
            // $new_final_total = $request->customer_paid + $old_final_total
            $new_final_total = $request->customer_paid + $old_final_total;
            // total customer paid
            $total_customer_paid = $new_final_total;
            // Create "new payment"
            $payment_data =
            [
                'production_transaction_id' => $due_transaction->id,
                'customer_id'               => $due_payment->customer_id,
                'amount'                    => $due_payment->amount,
                'customer_rest'             => $request->rest_paid,
                'sum_total_cost'            => $due_payment->sum_total_cost,
                'payment_type'              => 'cash',
                'payment_date'              => date('Y-m-d'),
                'created_by'                => auth()->user()->id
            ];
            // =============== if "customer_paid" < "dueAmount" ===============
            if( $request->customer_paid < $request->dueAmount )
            {
                // "prod_transaction_payments" table   : Update "customer_paid" in DB
                // $due_payment->update(['customer_paid' => $new_customer_paid]);
                $payment_data['customer_paid'] = $request->customer_paid;
                $payment_data['payment_status']  = "partial";
                // "production_transactions" table : Update "final_total" in DB
                $due_transaction->update(['final_total' => $new_final_total ]);
            }
            // =============== if "customer_paid" == "dueAmount" ===============
            elseif( $request->customer_paid == $request->dueAmount )
            {
                // "prod_transaction_payments" table   : Update "customer_paid" in DB
                // $due_payment->update(['customer_paid' => $new_customer_paid ,'customer_rest' => '0' ,'payment_status'=>'paid']);
                $payment_data['customer_paid'] = $request->customer_paid;
                $payment_data['payment_status']  = "paid";
                // "production_transactions" table : Update "final_total" in DB
                // $due_transaction->update(['final_total' => $due_transaction->grand_total ,'status' => 'final' ,'payment_status'=>'paid']);
                $due_transaction->update(['final_total' => $total_customer_paid ,'status' => 'final' ,'payment_status'=>'paid']);
            }
            // =============== if "customer_paid" > "dueAmount" ===============
            else
            {
                // customer_rest : المتبقي للعميل
                $customer_rest = $request->rest_paid;
                // add "rest" to customer "balance" in customers table in DB
                if( $request->balance > 0 && $request->balance != null )
                {
                    // Update "customer_paid" in DB
                    $payment_data['customer_paid'] = $request->dueAmount ;
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
                    // Update "customer_paid" in DB
                    $payment_data['customer_paid'] = $request->customer_paid - $customer_rest;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionInvoices $productionInvoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionInvoices $productionInvoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionInvoices $productionInvoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionInvoices $productionInvoices)
    {
        //
    }
}
