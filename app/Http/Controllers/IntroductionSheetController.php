<?php

namespace App\Http\Controllers;

use App\Models\Caliber;
use Illuminate\Http\Request;
use App\Models\IntroductionSheet;
use App\Models\Opening;
use App\Models\Screening;
use App\Models\System;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IntroductionSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $introductionSheets = IntroductionSheet::with(['createBy', 'updateBy'])->orderBy('created_at', 'desc')->get();
        return view('introduction_sheet.index',compact('introductionSheets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $processes = IntroductionSheet::getProcesses();
        $caliber = Caliber::latest()->pluck('number');
        return view("introduction_sheet.create",compact('processes','caliber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        try
        {
            $request->validate([
                'car_sku.*' => 'required|string|max:255',
                'process_type.*' => 'required',
                'process.*' => 'required',
                'caliber.*' => 'required',
            ]);
            // Loop through each row in the sheet and save to the database
            foreach ($request->input('car_sku') as $key => $value)
            {
                IntroductionSheet::create([
                    'car_sku' => $value,
                    'process_type' => $request->input('process_type')[$key],
                    'process' => $request->input('process')[$key],
                    'caliber' => $request->input('caliber')[$key],
                    'car_barcode' => $value,
                    'created_by' => auth()->user()->id
                ]);
            }
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
            return redirect()->route('introduction-sheet.index')->with('status', $output);
        }
        catch (\Exception $e)
        {
            // Handle exceptions or validation errors
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(IntroductionSheet $introductionSheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $introductionSheet = IntroductionSheet::findOrFail($id);
        $processes = IntroductionSheet::getProcesses();
        $caliber = Caliber::latest()->pluck('number');
        // dd($introductionSheet);
        return view('introduction_sheet.edit',compact('introductionSheet','processes','caliber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try
        {
            $introductionSheet = IntroductionSheet::findOrFail($id);
            $data = [
                "car_sku" => $request->car_sku ,
                "process" => $request->process ,
                "process_type" => $request->process_type ,
                "caliber" => $request->caliber ,
                // "car_barcode" => $request->car_barcode ,
                "edited_by" => auth()->user()->id
            ];
            $introductionSheet->update($data);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
            return redirect()->route('introduction-sheet.index')->with('status', $output);
        }
        catch (\Exception $e)
        {
            dd($e);
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
            return redirect()->back()->with('status', $output);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try
        {
            $introductionSheet = IntroductionSheet::findOrFail($id);
            $introductionSheet->deleted_by = Auth::user()->id;
            $introductionSheet->delete();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        }
        catch (\Exception $e)
        {
              Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
              $output = [
                  'success' => false,
                  'msg' => __('lang.something_went_wrong')
              ];
        }
        return $output;
    }

    // ++++++++++++++++++++++++ Get "sheet row" +++++++++++++++++++++
    public function getSheetRow($row_index)
    {
        $processes = IntroductionSheet::getProcesses();
        $caliber = Caliber::latest()->pluck('number');
        return view('introduction_sheet.partials.sheet_row')->with(compact(
            'processes','caliber','row_index'
        ));
    }
    // ++++++++++++++ fetchProcesses(): to get "Processes" of "selected process_type" selectbox ++++++++++++++
    public function fetchProcesses(Request $request)
    {
        // dd($request->process_type_val);
        if ($request->process_type_val == "original_store")
        {
            $data['process_type_val'] = ["0" => "طلب فتح" , "1" => "شغل تلقائي"];
            return response()->json($data); // return an empty array for original_store
        }
        elseif ($request->process_type_val == "openning")
        {
            $data['process_type_val'] = Opening::pluck('name', 'name')->toArray();
            return response()->json($data);
        }
        elseif ($request->process_type_val == "squeeze")
        {
            $data['process_type_val'] = ["0" => "squeeze"];
            return response()->json($data);
        }
        elseif ($request->process_type_val == "sort")
        {
            $data['process_type_val'] = Screening::pluck('name', 'name')->toArray();
            return response()->json($data);
        }
    }
    // +++++++++++++++++++++ print invoice +++++++++++++++++
    public  function print($id)
    {
        try
        {
            $introductionSheet = IntroductionSheet::find($id);
            return view('introduction_sheet.partials.invoice',compact('introductionSheet'));
        }
        catch (\Exception $e)
        {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
            return $output;
        }
    }
    public function printBarcode($id)
    {
        $introductionSheet = IntroductionSheet::findOrFail($id);
        return view('introduction_sheet.partials.print_barcode',compact('introductionSheet'));
    }
}
