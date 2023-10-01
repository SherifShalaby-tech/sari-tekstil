<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Caliber;
use App\Models\CarExtra;
use App\Models\Cars;
use App\Models\Employee;
use App\Models\Opening;
use App\Models\Screening;
use App\Models\Store;
use App\Models\System;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlanningCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('settings_module.cars.view')) {
            abort(403, __('lang.unauthorized_action'));
        }
        $disabled = false;
        if (auth()->user()->can('settings_module.cars.edit')) {
            $disabled = true;
        }
        // $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('recent_car_content');
        // $recent_car_contents->prepend( __('lang.empty'));
        // $recent_car_contents=$recent_car_contents->all();
        $cars = Cars::when(\request()->branch_id != null, function ($query) {
                $query->where('branch_id', \request()->branch_id);
            })
            ->when(\request()->employee_id != null, function ($query) {
                $query->where('employee_id', \request()->employee_id);
            })
            ->when(\request()->recent_process != null, function ($query) {
                $query->where('process', \request()->recent_process);
            })
            ->when(\request()->caliber_id != null, function ($query) {
                $query->where('caliber_id', \request()->caliber_id);
            })
            // ->when(\request()->recent_car_content != null, function ($query) {
            //     if(request()->recent_car_content==0){
            //         $query->whereNull('recent_car_content');
            //     }else{
            //         $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('recent_car_content');
            //         $recent_car_contents->prepend( __('lang.empty'));
            //         $recent_car_contents=$recent_car_contents->all();
            //         $query->where('recent_car_content',$recent_car_contents[request()->recent_car_content]);
            //     }
            // })
            ->when(\request()->created_by != null, function ($query) {
                $query->where('created_by', \request()->created_by);
            })
            ->when(\request()->input('empty_carts_val') == true, function ($query) {
                $query->where('weight_empty', '=', 0);
            })
            ->when(\request()->input('occupied_carts_val') == true, function ($query) {
                $query->where('weight_empty', '>=', 0);
            })->latest()->get();
        $stores = Store::latest()->pluck('name', 'id');
        $branches = Branch::latest()->pluck('name', 'id');
        $calibars = Caliber::latest()->pluck('number', 'id');
        $processes = Cars::getProcesses();
        $employees = Employee::latest()->pluck('name', 'id');
        ////////
        $storeNames = Store::latest()->pluck('name');
        $openingNames = Opening::latest()->pluck('name');
        $screeningNames = Screening::latest()->pluck('name');
        $places = $storeNames->concat($openingNames)->concat($screeningNames);
        $places->push(__('lang.square'));
        $places = $places->all();
        ///////
        $users = User::latest()->pluck('name', 'id');
        return view('cars.planning_carts.index', compact(
            'cars',
            'stores',
            'branches',
            'calibars',
            'processes',
            'employees',
            'places',
            'disabled',
            'users'
        ));
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
        if (!auth()->user()->can('settings_module.cars.create')) {
            abort(403, __('lang.unauthorized_action'));
        }
        try {
            $selectedData = $request->selectedData;
            $ids = [];
            for ($i = 0; $i < count($selectedData); $i++) {
                // return $selectedData[$i]['id'];
                Cars::find($selectedData[$i]['id'])->update(
                    $selectedData[$i]
                );
                CarExtra::where('cars_id', $selectedData[$i]['id'])->delete();

                $employee_id = $selectedData[$i]['employee_id'];
                for ($x = 0; $x < count($employee_id); $x++) {
                    CarExtra::create([
                        'cars_id' => $selectedData[$i]['id'],
                        'employee_id' => $employee_id[$x]
                    ]);
                }
                $next_employee_id = $selectedData[$i]['next_employee_id'];
                for ($x = 0; $x < count($next_employee_id); $x++) {
                    CarExtra::create([
                        'cars_id' => $selectedData[$i]['id'],
                        'next_employee_id' => $next_employee_id[$x]
                    ]);
                }
    
                $caliber_id = $selectedData[$i]['caliber_id'];
                for ($x = 0; $x < count($caliber_id); $x++) {
                    CarExtra::create([
                        'cars_id' => $selectedData[$i]['id'],
                        'caliber_id' => $caliber_id[$x]
                    ]);
                }
                $ids[] = $selectedData[$i]['id'];
            }
            $html_content = '';
            if (isset($request->print)) {
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
            $cars = Cars::whereIn('id', $ids)->get();
        } else {
            $cars = Cars::whereIn('id', $ids)->get();
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
        if (!auth()->user()->can('settings_module.cars.create') || !auth()->user()->can('settings_module.cars.edit')) {
            abort(403, __('lang.unauthorized_action'));
        }
        $car = Cars::find($id);
        $branches = Branch::latest()->pluck('name', 'id');
        $processes = Cars::getProcesses();
        $employees = Employee::latest()->pluck('name', 'id');
        ////////
        $storeNames = Store::latest()->pluck('name');
        $openingNames = Opening::latest()->pluck('name');
        $screeningNames = Screening::latest()->pluck('name');
        $places = $storeNames->concat($openingNames)->concat($screeningNames);
        $places->push(__('lang.square'));
        $places = $places->all();
        ///////
        $calibars = Caliber::latest()->pluck('number', 'id');
        return view('cars.planning_carts.planing_cart_modal')->with(compact(
            'car',
            'branches',
            'processes',
            'employees',
            'places',
            'calibars'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->except('_token');
            $data['edited_by'] = Auth::user()->id;
            $car = Cars::find($id);
            $car->update($data);
            $car->car_extras()->delete();

            $calibers = $request->get('caliber_id');
            for ($i = 0; $i < count($calibers); $i++) {
                CarExtra::create([
                    'cars_id' => $car->id,
                    'caliber_id' => $calibers[$i]
                ]);
            }

            $employees = $request->get('employee_id');
            for ($i = 0; $i < count($employees); $i++) {
                CarExtra::create([
                    'cars_id' => $car->id,
                    'employee_id' => $employees[$i]
                ]);
            }

            $next_employees = $request->get('next_employee_id');
            for ($i = 0; $i < count($next_employees); $i++) {
                CarExtra::create([
                    'cars_id' => $car->id,
                    'next_employee_id' => $next_employees[$i]
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
        //
    }
    public function changeCartPlan(Request $request)
    {
        try {
            $cartData = $request->cartData;
            $car = Cars::find($cartData[0]['id']);
            Cars::find($cartData[0]['id'])->update($cartData[0]);
            CarExtra::where('cars_id', $cartData[0]['id'])->delete();

            $employee_id = $cartData[0]['employee_id'];
            for ($i = 0; $i < count($employee_id); $i++) {
                CarExtra::create([
                    'cars_id' => $car->id,
                    'employee_id' => $employee_id[$i]
                ]);
            }
            $next_employee_id = $cartData[0]['next_employee_id'];
            for ($i = 0; $i < count($next_employee_id); $i++) {
                CarExtra::create([
                    'cars_id' => $car->id,
                    'next_employee_id' => $next_employee_id[$i]
                ]);
            }

            $caliber_id = $cartData[0]['caliber_id'];
            for ($i = 0; $i < count($caliber_id); $i++) {
                CarExtra::create([
                    'cars_id' => $car->id,
                    'caliber_id' => $caliber_id[$i]
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

        return  $output;
    }
}
