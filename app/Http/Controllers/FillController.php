<?php

namespace App\Http\Controllers;

use App\Http\Requests\FillRequest;
use App\Http\Requests\UpdateFillRequest;
use App\Models\Fill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fills=Fill::latest()->get();
        return view('fills.index',compact('fills'));
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
    public function store(FillRequest $request)
    {
        try {
            $data = $request->except('_token');
            // $data['created_by']=Auth::user()->id;
            $fill = Fill::create($data);
            $output = [
                'success' => true,
                'id' => $fill->id,
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
        $fill = Fill::find($id);
        return view('fills.edit')->with(compact(
            'fill'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFillRequest $request, string $id)
    {
        try {
            $data['name'] = $request->name;
            // $data['edited_by'] = Auth::user()->id;
            Fill::find($id)->update($data);
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
            $fill=Fill::find($id);
            // $fill->deleted_by=Auth::user()->id;
            $fill->save();
            $fill->delete();
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
