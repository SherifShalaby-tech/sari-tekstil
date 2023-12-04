<?php

namespace App\Http\Controllers;

use App\Models\CarContents;
use App\Models\CarExtra;
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
        $batch_number=$this->generateUniqueBatchNumber();
        $processes=Cars::getProcesses();
        $employees=Employee::latest()->pluck('name','id');
        $skus=Cars::whereIn('process',['not_used','original_store'])->whereIn('next_process',['not_used','original_store'])->latest()->pluck('sku','id');
        return view('workers.original_stocks.filling.filling',compact('types','nationalities',
        'batch_number','processes','employees','skus'));
    }
    public function generateUniqueBatchNumber() {
        do {
            $batchNumber = mt_rand(100000, 999999); 
            $existingCount = Cars::where('batch_number', $batchNumber)->count();
        } while ($existingCount > 0);
        return $batchNumber;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['created_by']=Auth::user()->id;
            $data['employee_id']=Employee::find(Auth::user()->id)->id;
            $data['car_id']=$request->sku;
            $data['workers']=$request->workers;
            $fill = FillingByOriginalStore::create($data);

            $car=Cars::find($data['car_id']);
            $car->weight_product=$car->weight_product + (float)$request->net_weight;
            $car->next_process=$request->process;
            $car->type_id=$car->type_id;
            if($request->process!=='original_store'){
            $car->batch_number=$request->batch_number;
            }
            $car->save();
            $workers=$request->get('workers');
            for($i=0; $i<count($workers);$i++){
                CarExtra::create([
                    'cars_id'=>$car->id,
                    'next_employee_id'=>$workers[$i]
                ]);    
            }
            

            $indexs=[];
            if($request->has('nationality_id')){
                if(count($request->nationality_id)>0){
                    $indexs=array_keys($request->nationality_id);
                }
            }
            foreach ($indexs as $index){
                CarContents::create([
                    'car_id'=>$car->id,
                    'filling_by_original_store_id'=>$fill->id,
                    'nationality_id'=>$request->nationality_id[$index],
                    'percentage'=>$request->percentage[$index],
                    'weight'=>$request->weight[$index],
                    'goods_weight'=>$request->actual_weight[$index],
          
                ]); 
                // $items=[
                //     'filling_by_original_store_id' => $fill->id,
                //     'nationality_id' => $request->nationality_id[$index],
                //     'percent' => $request->percent[$index],
                //     'weight' => $request->weight[$index],
                //     'actual_weight' => $request->actual_weight[$index],
                // ];
                // FillingByOriginalStoreNationality::create($items);
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

            $car=Cars::find($data['car_id']);
            $car->weight_product=$car->weight_product + (float)$request->net_weight;
            $car->next_process=$request->process;
            $car->type_id=$car->type_id;
            if($request->process!=='original_store'){
            $car->batch_number=$request->batch_number;
            }
            $car->save();
            $workers=$request->get('workers');
            for($i=0; $i<count($workers);$i++){
                $car->car_extras()->update([
                    'next_employee_id'=>$workers[$i]
                ]);    
            }


            $indexs=[];
            $filling_store->car_contents()->delete();
            if($request->has('nationality_id')){
                if(count($request->nationality_id)>0){
                    $indexs=array_keys($request->nationality_id);
                }
            }
            foreach ($indexs as $index){
                CarContents::create([
                    'car_id'=>$car->id,
                    'filling_by_original_store_id'=>$fill->id,
                    'nationality_id'=>$request->nationality_id[$index],
                    'percentage'=>$request->percentage[$index],
                    'weight'=>$request->weight[$index],
                    'goods_weight'=>$request->actual_weight[$index],
          
                ]); 
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
            CarContents::where('filling_by_original_store_id',$fill->id)->delete();
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
