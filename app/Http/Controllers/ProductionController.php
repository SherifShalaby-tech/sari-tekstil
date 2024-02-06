<?php

namespace App\Http\Controllers;

use App\Models\FillPressRequest;
use App\Models\Production;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    /* ++++++++++++++++ index() ++++++++++++++++ */
    public function index()
    {
        $productions = Production::all();
        // dd($fill_press_requests);
        return view('production.index',compact('productions'));
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

    /**
     * Store a newly created resource in storage.
     */
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
                    $production->fill_press_request_id = $product['fill_press_request_id'];
                    $production->sku = $product['sku'];
                    $production->association_number = $product['association_number'];
                    $production->delivery_number = $product['delivery_number'];
                    $production->operating_number = $product['operating_number'];
                    $production->packing_type = $product['packing_type'];
                    $production->current_location = $product['current_location'];
                    $production->weight = $product['weight'];
                    $production->production_date = now();
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
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
            return redirect()->route('production.index')->with('status', $output);
        }
        catch (\Exception $e)
        {
            dd($e);
            // Handle exceptions or validation errors
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function invoice()
    {
        $invoice = Production::all();
        // dd($invoice);
        return view('production.invoices',compact('invoice'));
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
}
