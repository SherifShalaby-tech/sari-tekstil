<?php

namespace App\Http\Controllers;

use App\Models\Caliber;
use App\Models\Color;
use App\Models\Employee;
use App\Models\Fill;
use App\Models\FillingRequest;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FillingRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fillingRequests=FillingRequest::latest()->get();
        // return  $fillingRequests->fills;
        return view('admin.filling_request_index',compact('fillingRequests'));
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
        return view('admin.filling_request_create')->with(compact(
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
            // return $request;
            $fillingIds = $request->input('filling_id');
            $emptyWeights = $request->input('empty_weight');
            $requestedWeights = $request->input('requested_weight');
            $calibers = $request->input('calibers');
            $screeningIds = $request->input('screening_id');
            $destinations = $request->input('destinations');
            $quantities = $request->input('quantity');
            $employeeIds = $request->input('employee_id');
            $colorIds = $request->input('color_id');
            // foreach ($fillingIds as $index => $fillingId) {
                // return $index;
                // return $fillingIds;
                foreach ($calibers as $index => $caliberSet) {
                    // return $index;
                    // return $caliberSet;
                    FillingRequest::create([
                        'source' => $request->input('source'),
                        'filling_id' => $fillingIds[$index - 1],
                        'empty_weight' => $emptyWeights[$index-1],
                        'requested_weight' => $requestedWeights[$index-1],
                        'calibers' => $caliberSet, // Convert to JSON if needed
                        'screening_id' => $screeningIds[$index-1],
                        'destination' => $destinations[$index-1],
                        'priority' => $request->input('priority'),
                        'notes' => $request->input('notes'),
                        'quantity' => $quantities[$index -1 ],
                        'employee_id' => $employeeIds[$index-1],
                        'color_id' => $colorIds[$index-1],
                        'created_by' => Auth::user()->id,
                    ]);
                }
            // }

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

    public function addFiliingRow(){
        $fills = Fill::pluck('name', 'id');
        $screening = Screening::pluck('name', 'id');
        $calibers=Caliber::pluck('number');
        $employees=Employee::pluck('name', 'id');
        $colors=Color::pluck('name', 'id');
        $hideBtn=0;
        $weight_product='';
        // return "Hello from addNationalityRow";
        return view('admin.partials.add_filling_row',compact('fills',
        'screening',
        'calibers',
        'employees',
        'colors','hideBtn'));
    }
}
