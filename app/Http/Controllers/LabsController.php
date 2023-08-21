<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LabsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labs=Lab::latest()->get();
        return view('labs.index',compact('labs'));
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
                $lab = Lab::create($data);
                $output = [
                    'success' => true,
                    'id' => $lab->id,
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
        $lab = Lab::find($id);
        return view('labs.edit')->with(compact(
            'lab'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data['name'] = $request->name;
            $data['edited_by'] = Auth::user()->id;
            Lab::find($id)->update($data);
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
            $lab=Lab::find($id);
            $lab->deleted_by=Auth::user()->id;
            $lab->save();
            $lab->delete();
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
}
