<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarsRequest;
use App\Http\Requests\UpdateCarsRequest;
use App\Models\Branch;
use App\Models\Caliber;
use App\Models\Cars;
use App\Models\Store;
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
        $cars=Cars::latest()->get();
        $stores =Store::latest()->pluck('name', 'id');
        $branches=Branch::latest()->pluck('name', 'id');
        $calibars=Caliber::latest()->pluck('number', 'id');
        return view('cars.index',compact('cars','stores','branches','calibars'));
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
