<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Employee;
use App\Models\FillingByOriginalStore;
use App\Models\FillingByOriginalStoreNationality;
use App\Models\Nationality;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FillingByOriginalStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fillings=FillingByOriginalStore::where('employee_id',Employee::find(Auth::user()->id)->id)->latest()->get();
        return view('workers.original_stocks.filling.index',compact('fillings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('orignal_store_worker')) {
            abort(403, __('lang.unauthorized_action'));
        }
        $types=Type::latest()->pluck('name','id');
        $nationalities=Nationality::latest()->pluck('name','id');
        $batch_number=11;
        $processes=Cars::getProcesses();
        $employees=Employee::latest()->pluck('name','id');
        $skus=Cars::latest()->pluck('sku','id');
        return view('workers.original_stocks.filling.filling',compact('types','nationalities',
        'batch_number','processes','employees','skus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            // $data['created_by']=Auth::user()->id;
            $data['employee_id']=Employee::find(Auth::user()->id)->id;
            $data['car_id']=$request->sku;
            $data['workers']=$request->workers;
            $fill = FillingByOriginalStore::create($data);

            $indexs=[];
            if($request->has('nationality_id')){
                if(count($request->nationality_id)>0){
                    $indexs=array_keys($request->nationality_id);
                }
            }
            foreach ($indexs as $index){
                $items=[
                    'filling_by_original_store_id' => $fill->id,
                    'nationality_id' => $request->nationality_id[$index],
                    'percent' => $request->percent[$index],
                    'weight' => $request->weight[$index],
                    'actual_weight' => $request->actual_weight[$index],
                ];
                FillingByOriginalStoreNationality::create($items);
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
        if (!auth()->user()->can('orignal_store_worker')) {
            abort(403, __('lang.unauthorized_action'));
        }
        $fill=FillingByOriginalStore::find($id);
        $types=Type::latest()->pluck('name','id');
        $nationalities=Nationality::latest()->pluck('name','id');
        $batch_number=11;
        $processes=Cars::getProcesses();
        $employees=Employee::latest()->pluck('name','id');
        $skus=Cars::latest()->pluck('sku','id');
        return view('workers.original_stocks.filling.edit',compact('fill','types','nationalities',
        'batch_number','processes','employees','skus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->except('_token');
            $filling_store=FillingByOriginalStore::find($id);
            $data['employee_id']=Employee::find(Auth::user()->id)->id;
            $data['car_id']=$request->sku;
            $data['workers']=$request->workers;
            $fill = $filling_store->update($data);

            $indexs=[];
            $filling_store->filling_by_original_store_nationalities()->delete();
            if($request->has('nationality_id')){
                if(count($request->nationality_id)>0){
                    $indexs=array_keys($request->nationality_id);
                }
            }
            foreach ($indexs as $index){
                $items=[
                    'filling_by_original_store_id' => $filling_store->id,
                    'nationality_id' => $request->nationality_id[$index],
                    'percent' => $request->percent[$index],
                    'weight' => $request->weight[$index],
                    'actual_weight' => $request->actual_weight[$index],
                ];
                FillingByOriginalStoreNationality::create($items);
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
        try {
            $fill=FillingByOriginalStore::find($id);
            $fill->deleted_by=Auth::user()->id;
            $fill->save();
            $fill_store=FillingByOriginalStoreNationality::where('filling_by_original_store_id',$fill->id)->delete();
            $fill->delete();
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
    
    public function getCartWeight(Request $request) {
        return Cars::find($request->car_id)->weight_product;
    }
}
