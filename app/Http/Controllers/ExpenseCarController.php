<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\ExpenseCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExpenseCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $data = $request->except('_token');
            $data['created_by']=Auth::user()->id;
            if ($request->hasFile('upload_files')) {
                $files=[];
                for ($i=0;$i<count($request->upload_files);$i++) {
                    $image= $request->upload_files[$i];
                    $ext = $image->getClientOriginalExtension();
                    $filename = rand(1111,9999).time() . '.' . $ext;
                    $image->move("uploads/cars/", $filename);
                    $files[]= $filename;
                }
                $data['files']=$files;
            }
            $carExpense= ExpenseCar::create($data);
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
        $expense_car=ExpenseCar::where('car_id',$id)->first();
        return view('cars.maintain_car')->with(compact(
            'car','expense_car'
        ));
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
