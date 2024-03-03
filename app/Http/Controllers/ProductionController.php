<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Caliber;
use App\Models\Customer;
use App\Models\Screening;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\ProductionLine;
use Illuminate\Support\Carbon;
use App\Models\FillPressRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionTransaction;
use App\Models\ProductionTransactionPayment;

class ProductionController extends Controller
{
    /* ++++++++++++++++ index() ++++++++++++++++ */
    public function index()
    {

        $productions=Production::
        when(\request()->color_id != null, function ($query) {
            $query->where('color_id',\request()->color_id);
        })
        ->when(\request()->start_date != null, function ($query) {
            $query->whereDate('production_date', '>=', request()->start_date);
        })
        ->when(\request()->end_date != null, function ($query) {
            $query->whereDate('production_date', '<=', request()->end_date);
        })
        ->when(\request()->caliber != null, function ($query) {
            $query->where('caliber',\request()->caliber);
        })
        ->latest()->get();
        // packing_types filters
        $packing_types = Production::select('packing_type')->get();
        // dd($packing_types);
        // colors filters
        $colors = Color::pluck('name','id');
        // current_content filters
        $current_content = Screening::pluck('name','id');
        // current_content filters
        $calibers = Caliber::pluck('number','number');
        // dd($current_content);
        return view('production.index',compact('productions','packing_types','colors','current_content','calibers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id)
    {

    }
    public function create()
    {
        $fill_press_requests = FillPressRequest::with('press_request')->where('status',null)->get();
        // dd($fill_press_requests);
        return view('production.create',compact('fill_press_requests'));
    }

    /* +++++++++++++++++ store() +++++++++++++++++ */
    public function store(Request $request)
    {
        try
        {
            // Retrieve products data from the request
            $products = $request->input('products');
            // Process only the checked rows
            foreach ($products as $product)
            {
                // Check if the checkbox is checked
                if (isset($product['checkbox']) && $product['checkbox'] == 1)
                {
                    // Create a new Production instance
                    $production = new Production();
                    // Fill the Production model with data from the form
                    $production->production_id = $product['production_id'];
                    $production->sku = $product['sku'];
                    $production->association_number = $product['association_number'];
                    $production->delivery_number = $product['delivery_number'];
                    $production->operating_number = $product['operating_number'];
                    $production->packing_type = $product['packing_type'];
                    $production->current_location = $product['current_location'];
                    $production->weight = $product['weight'];
                    $production->production_date = date('Y-m-d');
                    $production->weight = $product['weight'];
                    $production->last_worker = $product['last_worker'];
                    $production->cost_per_unit = $product['cost_per_unit'];
                    $production->original_content = $product['original_content'];
                    $production->current_content = $product['current_content'];
                    $production->caliber = $product['caliber'];
                    $production->color_id  = $product['color_id'];
                    $production->quantity  = $product['quantity'];
                    $production->total_cost	  = $product['total_cost'];
                    // Update "Fill Press Request" Status to "production"
                    FillPressRequest::where('id',$production->fill_press_request_id)->update(['status' => 'production']);
                    $production->save();
                }
            }
            return view('production.invoices',compact('production'));
        }
        catch (\Exception $e)
        {
            dd($e);
            // Handle exceptions or validation errors
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /* ====================== invoice ========================== */
    public function invoice(Request $request)
    {
        $sum_total_cost = $request->sum_total_cost;
        $customers = Customer::all();
        $productions = $request->input('products');
        $getPaymentStatusArray = $this->getPaymentStatusArray();
        $getPaymentTypeArray = $this->getPaymentTypeArray();
        // dd($productions);
        return view('production.invoice', compact('productions','sum_total_cost','customers','getPaymentStatusArray','getPaymentTypeArray'));
    }
    /* ====================== invoice ========================== */
    public function store_invoice(Request $request)
    {
        // DD($request);
        try
        {
            DB::beginTransaction();
            // Retrieve productions data from the request
            $products = $request->input('products');
            // ++++++++++++++++++++ production_transaction table ++++++++++++++++++++
            // Create a new production_transaction instance and populate it with data from the request
            $production_transaction                     = new ProductionTransaction();
            $production_transaction->store_id           = 1;
            $production_transaction->employee_id        = auth()->user()->id;
            $production_transaction->customer_id        = $request->customer_id;
            $production_transaction->type               = "invoice";
            $production_transaction->invoice_no         = $this->generateInvoivceNumber();
            $production_transaction->grand_total        = $request->sum_total_cost;
            $production_transaction->transaction_date   = now();
            $production_transaction->payment_status     = $request->payment_status;
            $production_transaction->created_by         = auth()->user()->id;
            // Customer paid less than required amount
            if($request->customer_paid < $request->amount)
            {
                $production_transaction->payment_status = "partial";
                $production_transaction->status = "partial";
                $production_transaction->final_total = $request->customer_paid;
            }
            // Customer paid equal to required amount
            elseif($request->customer_paid == $request->amount)
            {
                $production_transaction->payment_status = "paid";
                $production_transaction->status = "final";
                $production_transaction->final_total = $request->customer_paid;
            }
            // Customer paid greater than required amount
            else{
                $production_transaction->final_total = $request->sum_total_cost;
                $production_transaction->payment_status = "paid";
                $production_transaction->status = "final";
            }
            // Save the production_transaction to the database
            $production_transaction->save();

            // Process only the checked rows
            // ++++++++++++++++++++ production_lines table ++++++++++++++++++++
            foreach ($products as $product)
            {
                // Create a new ProductionTransaction instance
                $production_line = new ProductionLine();
                // Fill the Production model with data from the form
                $production_line->production_id             = $product['production_id'];
                $production_line->production_transaction_id = $production_transaction->id;
                $production_line->quantity                  = $product['quantity'];
                $production_line->sell_price                = $product['sell_price'];
                $production_line->sub_total                 = $product['total_cost'];
                $production_line->save();
            }
            // ++++++++++++++++++++ production_transaction_payments table ++++++++++++++++++++
            if ($request->payment_status != 'pending')
            {
                $payment_data = [
                    'production_transaction_id' => $production_transaction->id,
                    'customer_id'               => $request->customer_id ,
                    'amount'                    => $request->amount,
                    'customer_paid'             => ($request->customer_paid > $request->amount) ? $request->sum_total_cost : $request->customer_paid,
                    'customer_rest'             => $request->rest_paid,
                    'sum_total_cost'            => $request->sum_total_cost,
                    'payment_type'              => $request->payment_type,
                    'payment_status'            => $request->payment_status,
                    'payment_date'              => $request->payment_date,
                    'notes'                     => $request->notes,
                ];
                if (!empty($payment_data['amount']))
                {
                    $payment_data['created_by'] = Auth::user()->id;
                    // Create "ProductionTransactionPayment"
                    ProductionTransactionPayment::create($payment_data);
                }
                // +++++++++++++++++++ Update customer Balance +++++++++++++++
                // Get "customer_id"
                $customer_id = $request->input('customer_id');
                // Get "customer_balance"
                $customer_balance = $request->input('balance');
                // Get customer data
                $customer = Customer::findOrFail($customer_id);
                if ($customer)
                {
                    // Add the new balance to the existing balance
                    $new_balance = $customer->balance + $customer_balance;
                    // Update the customer balance
                    $customer->update(['balance' => $new_balance]);
                }
                DB::commit();
            }
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
            return redirect()->route('production.index')->with('status', $output);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }
    }
    // ++++++++++++++++ Get Customer info ++++++++++++++++
    public function getCustomerInfo(Request $request)
    {
        $data['customer_info'] = Customer::where('id', $request->id)->first();
        return response()->json($data);
    }
    // +++++++++++++++++++ Update customer Balance +++++++++++++++
    public function update_customer_balance(Request $request)
    {
        // Get "customer_id"
        $customer_id = $request->input('customer_id');
        // Get "customer_balance"
        $customer_balance = $request->input('customer_balance');
        // Get customer data
        $customer = Customer::find($customer_id);
        if ($customer)
        {
            // Add the new balance to the existing balance
            $new_balance = $customer->balance + $customer_balance;
            // Update the customer balance
            $customer->update(['balance' => $new_balance]);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        }
        else
        {
            $output = [
                'error' => true,
                'msg' => __('lang.success')
            ];
        }
        return $output;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Production $production)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Production $production)
    {
        //
    }
    // +++++++++++ getPaymentStatusArray() +++++++++++
    public function getPaymentStatusArray()
    {
        return [
            'partial' => __('lang.partially_paid'),
            'paid' => __('lang.paid'),
            'pending' => __('lang.pay_later'),
        ];
    }
    // +++++++++++ getPaymentTypeArray() +++++++++++
    public function getPaymentTypeArray()
    {
        return [
            'cash' => __('lang.cash'),
            'visa' => __('lang.visa'),
        ];
    }
    // +++++++++++ generateInvoivceNumber() : generate random invoice_number +++++++++++
    public function generateInvoivceNumber($i = 1)
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $inv_count = ProductionTransaction::all()->count() + $i;

        $invoice_no = 'Inv' . $year . $month . $inv_count;


        return $invoice_no;
    }
}
