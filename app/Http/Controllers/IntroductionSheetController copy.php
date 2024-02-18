<?php

namespace App\Http\Controllers;

use App\Models\Caliber;
use Illuminate\Http\Request;
use App\Models\IntroductionSheet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IntroductionSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $introductionSheets = IntroductionSheet::with(['createBy', 'updateBy'])
        ->orderBy('created_at', 'desc')
        ->get();
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
        dd($request);
        try
        {
            $request->validate([
                'car_sku' => 'required|max:255',
                'process' => 'required|max:255',
                'process_type' => 'required|max:255',
            ]);
            $data = [
                "car_sku" => $request->car_sku ,
                "process" => $request->process ,
                "process_type" => $request->process_type ,
                "caliber" => $request->caliber ,
                "car_barcode" => $request->car_barcode ,
                "created_by" => auth()->user()->id
            ];
            IntroductionSheet::create($data);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];

            return redirect()->route('introduction-sheet.index')->with('status', $output);
        }
        catch (\Exception $e)
        {
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
                "car_barcode" => $request->car_barcode ,
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
}
