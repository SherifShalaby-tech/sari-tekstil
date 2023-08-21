<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('settings_module.colors.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $colors=Color::latest()->get();
        return view('colors.index',compact('colors'));
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
    public function store(ColorRequest $request)
    {
        try {
            $data = $request->except('_token');
            $data['created_by']=Auth::user()->id;
            $color = Color::create($data);
            $output = [
                'success' => true,
                'id' => $color->id,
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
        if(!auth()->user()->can('settings_module.colors.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        $color = Color::find($id);
        return view('colors.edit')->with(compact(
            'color'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, string $id)
    {
        try {
            $data['name'] = $request->name;
            $data['edited_by'] = Auth::user()->id;
            Color::find($id)->update($data);
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
            $color=Color::find($id);
            $color->deleted_by=Auth::user()->id;
            $color->save();
            $color->delete();
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
