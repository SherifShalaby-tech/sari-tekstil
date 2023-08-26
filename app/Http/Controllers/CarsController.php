<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarsRequest;
use App\Http\Requests\UpdateCarsRequest;
use App\Models\Branch;
use App\Models\Caliber;
use App\Models\Cars;
use App\Models\Employee;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('settings_module.cars.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        // return request()->input('empty_carts');
        $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('id','recent_car_content');
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
        $users=User::latest()->pluck('name', 'id');
        $stores =Store::latest()->pluck('name', 'id');
        $branches=Branch::latest()->pluck('name', 'id');
        $calibars=Caliber::latest()->pluck('number', 'id');
        $processes=Cars::getProcesses();
        $employees=Employee::latest()->pluck('name', 'id');
        $places=Store::latest()->pluck('name', 'id');
        $places->push( __('lang.square'));
        $places=$places->all();
        $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('recent_car_content');
        $recent_car_contents->prepend( __('lang.empty'));
        $recent_car_contents=$recent_car_contents->all();
        return view('cars.index',compact('cars','stores','branches','calibars',
            'processes','employees','places','users','recent_car_contents'));
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
    public function store(StoreCarsRequest $request)
    {
        try {
            $data = $request->except('_token');
            $data['sku'] = !empty($request->sku) ? $request->sku : $this->generateSku($request->name);
            $data['created_by']=Auth::user()->id;
            $car = Cars::create($data);
            $output = [
                'success' => true,
                'id' => $car->id,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }
        if ($request->quick_add) {
          return $output;
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
        if(!auth()->user()->can('settings_module.cars.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        $car = Cars::find($id);
        $stores = Store::pluck('name', 'id');
        $branches=Branch::latest()->pluck('name', 'id');
        return view('cars.edit')->with(compact(
            'car',
            'stores',
            'branches'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarsRequest $request, string $id)
    {
        try {
            $data = $request->except('_token');
            $data['sku'] = !empty($request->sku) ? $request->sku : $this->generateSku($request->name);
            $data['edited_by'] = Auth::user()->id;
            Cars::find($id)->update($data);
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
            $car =Cars::find($id);
            $car->deleted_by=Auth::user()->id;
            $car->save();
            $car->delete();
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
    public function generateSku($name, $number = 1)
    {
        $name_array = explode(" ", $name);
        $sku = '';
        foreach ($name_array as $w) {
            if (!empty($w)) {
                if (!preg_match('/[^A-Za-z0-9]/', $w)) {
                    $sku .= $w[0];
                }
            }
        }
        // $sku = $sku . '-' . $number;
        $sku = $sku . $number;
        $sku_exist = Cars::where('sku', $sku)->exists();

        if ($sku_exist) {
            return $this->generateSku($name, $number + 1);
        } else {
            return $sku;
        }
    }
}
