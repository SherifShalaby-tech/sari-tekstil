<?php

namespace App\Http\Controllers;

use App\Models\TyingBale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TyingBalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bales=TyingBale::latest()->get();
        return view('workers.compression.tying_bales.index',compact('bales'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workers.compression.tying_bales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        try {
            $color=TyingBale::find($id);
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
