<?php

namespace App\Http\Controllers;

use App\Models\Caliber;
use App\Models\Color;
use App\Models\Employee;
use App\Models\Fill;
use App\Models\FillingRequest;
use App\Models\PressingRequest;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PressingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pressingRequests=PressingRequest::latest()->get();
        return view('admin.pressing_request_index',compact('pressingRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fills = Fill::pluck('name', 'id');
        $screening = Screening::pluck('name', 'id');
        $calibers=Caliber::pluck('number');
        $employees=Employee::pluck('name', 'id');
        $colors=Color::pluck('name', 'id');
        return view('admin.pressing_request_create')->with(compact(
            'fills',
            'screening',
            'calibers',
            'employees',
            'colors',

        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $fillingIds = $request->input('filling_id');
            $emptyWeights = $request->input('empty_weight');
            $requestedWeights = $request->input('requested_weight');
            $calibers = $request->input('calibers');
            $screeningIds = $request->input('screening_id');
            $destinations = $request->input('destination');
            $quantities = $request->input('quantity');
            // $employeeIds = $request->input('employee_id');
            $colorIds = $request->input('color_id');

            foreach ($fillingIds as $index => $fillingId) {
                FillingRequest::create([
                    'source' => $request->input('source'),
                    'filling_id' => $fillingId,
                    'empty_weight' => $emptyWeights[$index],
                    'requested_weight' => $requestedWeights[$index],
                    'calibers' => json_encode($calibers[$index]), // Convert to JSON if needed
                    'screening_id' => $screeningIds[$index],
                    'destination' => $destinations[$index],
                    'priority' => $request->input('priority'),
                    // 'notes' => $request->input('notes'),
                    'quantity' => $quantities[$index],
                    // 'employee_id' => $employeeIds[$index],
                    'color_id' => $colorIds[$index],
                    'created_by' => Auth::user()->id,
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

    public function addPressingRow(){
        $fills = Fill::pluck('name', 'id');
        $screening = Screening::pluck('name', 'id');
        $calibers=Caliber::pluck('number');
        $employees=Employee::pluck('name', 'id');
        $colors=Color::pluck('name', 'id');
        $hideBtn=0;
        $weight_product='';
        // return "Hello from addNationalityRow";
        return view('admin.partials.add_nationalities',compact('fills',
        'screening',
        'calibers',
        'employees',
        'colors','hideBtn'));
    }
}
