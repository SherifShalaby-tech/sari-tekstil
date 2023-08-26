<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Caliber;
use App\Models\Cars;
use App\Models\Employee;
use App\Models\Store;
use App\Models\System;
use App\Models\User;
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
        $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('recent_car_content');
        $recent_car_contents->prepend( __('lang.empty'));
        $recent_car_contents=$recent_car_contents->all();
        $cars=Cars::
        when(\request()->branch_id != null, function ($query) {
            $query->where('branch_id',\request()->branch_id);
        })
        ->when(\request()->employee_id != null, function ($query) {
            $query->where('employee_id',\request()->employee_id);
        })
        ->when(\request()->recent_process != null, function ($query) {
            $query->where('recent_process',\request()->recent_process);
        })
        ->when(\request()->caliber_id != null, function ($query) {
            $query->where('caliber_id',\request()->caliber_id);
        })
        ->when(\request()->recent_car_content != null, function ($query) {
            $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('recent_car_content');
            $recent_car_contents->prepend( __('lang.empty'));
            $recent_car_contents=$recent_car_contents->all();
            $query->where('recent_car_content',$recent_car_contents[request()->recent_car_content]);
        })
        ->when(\request()->created_by != null, function ($query) {
            $query->where('created_by',\request()->created_by);
        })
        ->when(\request()->input('empty_carts_val')==true, function ($query) {
            $query->where('weight_empty','=',0);
        })
        ->when(\request()->input('occupied_carts_val') ==true, function ($query) {
            $query->where('weight_empty','>=',0);
        })->
        latest()->get();
        $stores =Store::latest()->pluck('name', 'id');
        $branches=Branch::latest()->pluck('name', 'id');
        $calibars=Caliber::latest()->pluck('number', 'id');
        $processes=Cars::getProcesses();
        $employees=Employee::latest()->pluck('name', 'id');
        $places=Store::latest()->pluck('name', 'id');
        $places->push( __('lang.square'));
        $places=$places->all();
        $users=User::latest()->pluck('name', 'id');
        return view('cars.planning_carts.index',compact('cars','stores','branches',
        'calibars','processes','employees','places','disabled','recent_car_contents','users'));
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
            $html_content ='';
            if(isset($request->print)){
                $html_content = $this->getInvoicePrint($ids);
            }
            // return $cars=Cars::whereIn('id',$ids)->get();
            $output = [
                'success' => true,
                'html_content' => $html_content,
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
            $cars=Cars::whereIn('id',$ids)->get();
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
