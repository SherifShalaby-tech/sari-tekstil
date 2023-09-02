<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Employee;
use App\Models\FillingByOriginalStore;
use App\Models\FillingByOriginalStoreNationality;
use App\Models\Nationality;
use App\Models\RecieveStockOriginal;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OriginalStoreWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('orignal_store_worker')) {
            abort(403, __('lang.unauthorized_action'));
        }
        return view('workers.original_stocks.index');
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
        // return $request->all();
        try {
        $data = $request->except('_token');
        $data['created_by'] = Auth::user()->id;
        $employee_id = Employee::where('user_id', Auth::user()->id)->first()->id;
        foreach ($request->stock as $line) {
            if (isset($line->recive_stock) && $line->recive_stock) {
                $data_stock = [
                    'employee_id' => $employee_id,
                    'original_stock_id' => $line->original_stock_id,
                    'process' => $line->process,
                    'recent_weight' => $line->recent_weight,
                    'color_id' => $line->color_id,
                    'status' => $line->recive_stock,
                ];

                RecieveStockOriginal::create($data_stock);
            }
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
    public function addNationalityRow(Request $request){
        $nationalities=Nationality::latest()->pluck('name','id');
        $hideBtn=1;
        $weight_product='';
        if(isset($request->car_id)){
            $weight_product=Cars::find($request->car_id)->weight_product;
        }
        return view('workers.original_stocks.partials.add_nationalities',compact('nationalities','hideBtn','weight_product'));
    }
}
