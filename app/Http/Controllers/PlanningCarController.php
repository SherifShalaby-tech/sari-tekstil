<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Caliber;
use App\Models\Cars;
use App\Models\Employee;
use App\Models\Store;
use App\Models\System;
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
        $disabled=false;
        if(auth()->user()->can('settings_module.cars.edit')){
            $disabled=true;
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
       
        return view('cars.planning_carts.index',compact('cars','stores','branches',
        'calibars','processes','employees','places','disabled'));
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
        if(!auth()->user()->can('settings_module.cars.create')){
            abort(403, __('lang.unauthorized_action'));
        }
        try{
            $selectedData=$request->selectedData;
            $ids=[];
            for($i=0;$i<count($selectedData);$i++){
                // return $selectedData[$i]['id'];
                Cars::find($selectedData[$i]['id'])->update(
                    $selectedData[$i]
                );
                $ids[]=$selectedData[$i]['id'];
            }
            if(isset($request->print)){
                $html_content = $this->getInvoicePrint($ids);
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
        return $output;
    }
    public function getInvoicePrint($ids, $invoice_lang = null)
    {
        if (!empty($invoice_lang)) {
            $invoice_lang = $invoice_lang;
        } else {
            $invoice_lang = System::getProperty('invoice_lang');
            if (empty($invoice_lang)) {
                $invoice_lang = request()->session()->get('language');
            }
        }
        if ($invoice_lang == 'ar_and_en') {
            $cars=Cars::whereIn('id',$ids)->get();
        } else {
            $html_content = view('cars.partials.invoice')->with(compact(
                'cars',
                'invoice_lang',
            ))->render();
        }

        return $html_content;
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
