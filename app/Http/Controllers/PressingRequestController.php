<?php

namespace App\Http\Controllers;

use App\Models\Caliber;
use App\Models\Color;
use App\Models\Employee;
use App\Models\Fill;
use App\Models\FillingRequest;
use App\Models\PressingRequest;
use App\Models\PressingRequestTransaction;
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
        $pressing_request_transactions=PressingRequestTransaction::latest()->get();
        // $pressingRequests=PressingRequest::latest()->get();
        return view('admin.pressing_request_index',compact('pressing_request_transactions'));
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
            $pressing_request_transaction=PressingRequestTransaction::create([
                'priority' => $request->input('priority'),
                'status' => 1,
                'source' => $request->input('source'),
            ]);
            foreach ($calibers as $index => $caliberSet) {
                PressingRequest::create([
                    'pressing_request_transaction_id'=>$pressing_request_transaction->id,
                    'filling_id' => $fillingIds[$index - 1],
                    'empty_weight' => $emptyWeights[$index-1],
                    'weight' => $requestedWeights[$index-1],
                    'calibers' => $caliberSet, // Convert to JSON if needed
                    'screening_id' => $screeningIds[$index-1],
                    'destination' => $destinations[$index-1],
                    // 'priority' => $request->input('priority'),
                    'quantity' => $quantities[$index -1 ],
                    'color_id' => $colorIds[$index-1],
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
        $fills = Fill::pluck('name', 'id');
        $screening = Screening::pluck('name', 'id');
        $calibers=Caliber::pluck('number');
        $employees=Employee::pluck('name', 'id');
        $colors=Color::pluck('name', 'id');
        $pressing_request_transaction=PressingRequestTransaction::find($id);
        return view('admin.pressing_request_edit')->with(compact(
            'fills','pressing_request_transaction',
            'screening',
            'calibers',
            'employees',
            'colors',

        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            $pressing_rquests = $request->input('pressing_request_id');
            $pressing_request_transaction=PressingRequestTransaction::find($id)->update([
                'priority' => $request->input('priority'),
                'status' => 0,
                'source' => $request->input('source'),
            ]);
            foreach ($calibers as $index => $caliberSet) {
                if(!empty($pressing_rquests[$index - 1])){
                    PressingRequest::find($pressing_rquests[$index - 1])->update([
                        'pressing_request_transaction_id'=>$id,
                        'filling_id' => $fillingIds[$index - 1],
                        'empty_weight' => $emptyWeights[$index-1],
                        'weight' => $requestedWeights[$index-1],
                        'calibers' => $caliberSet, // Convert to JSON if needed
                        'screening_id' => $screeningIds[$index-1],
                        'destination' => $destinations[$index-1],
                        'quantity' => $quantities[$index -1 ],
                        'color_id' => $colorIds[$index-1],
                        'created_by' => Auth::user()->id,
                    ]);
                }else{
                    PressingRequest::create([
                        'pressing_request_transaction_id'=>$id,
                        'filling_id' => $fillingIds[$index - 1],
                        'empty_weight' => $emptyWeights[$index-1],
                        'weight' => $requestedWeights[$index-1],
                        'calibers' => $caliberSet, // Convert to JSON if needed
                        'screening_id' => $screeningIds[$index-1],
                        'destination' => $destinations[$index-1],
                        'quantity' => $quantities[$index -1 ],
                        'color_id' => $colorIds[$index-1],
                        'created_by' => Auth::user()->id,
                    ]);
                }
           
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
            $pressingRequestTransaction = PressingRequestTransaction::find($id);
            $presses = pressingRequest::where('pressing_request_transaction_id', $pressingRequestTransaction->id)->get();
            foreach ($presses as $press) {
                $press->deleted_by = Auth::user()->id;
                $press->save();
                $press->delete();
            }
            $pressingRequestTransaction->delete();
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

    public function addPressingRow(Request $request){
        $index = (int)$request->index;
        $index = $index + 1;
        $fills = Fill::pluck('name', 'id');
        $screening = Screening::pluck('name', 'id');
        $calibers=Caliber::pluck('number');
        // $employees=Employee::pluck('name', 'id');
        $colors=Color::pluck('name', 'id');
        $hideBtn=0;
        $weight_product='';
        // return "Hello from addNationalityRow";
        return view('admin.partials.add_pressing_row',compact('fills',
        'screening',
        'index',
        'calibers',
        // 'employees',
        'colors','hideBtn'));
    }
}
