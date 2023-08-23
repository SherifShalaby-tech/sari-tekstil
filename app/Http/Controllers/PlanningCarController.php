<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Caliber;
use App\Models\Cars;
use App\Models\Employee;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlanningCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('settings_module.cars.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $cars=Cars::latest()->get();
        $stores =Store::latest()->pluck('name', 'id');
        $branches=Branch::latest()->pluck('name', 'id');
        $calibars=Caliber::latest()->pluck('number', 'id');
        $processes=Cars::getProcesses();
        $employees=Employee::latest()->pluck('name', 'id');
        $places=Store::latest()->pluck('name', 'id');
        $places->push( __('lang.square'));
        $places=$places->all();
        return view('cars.planning_carts.index',compact('cars','stores','branches','calibars','processes','employees','places'));
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
    public function changeSku($id,Request $request){
        try{
            if(Cars::where('sku',$request->sku)->whereNull('deleted_at')->exists()){
                $output = [
                    'success' => false,
                    'msg' => __('lang.sku_repeated')
                ];
            }else{
                $car=Cars::find($id);
                $car->sku=$request->sku;
                $car->save();
                $output = [
                    'success' => true,
                    'msg' => __('lang.success')
                ];
            }
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }
        return $output;
    }
    public function changeWeightEmpty($id,Request $request){
        try{
            $car=Cars::find($id);
            $car->weight_empty=$request->weight_empty;
            $car->save();
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
    public function changeWeightProduct($id,Request $request){
        try{
            $car=Cars::find($id);
            $car->weight_product=$request->weight_product;
            $car->save();
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
