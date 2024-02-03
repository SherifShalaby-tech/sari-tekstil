<?php

namespace App\Http\Controllers;

use App\Models\FillPressRequest;
use App\Models\Production;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    /* ++++++++++++++++ index() ++++++++++++++++ */
    public function index()
    {
        $fill_press_requests = FillPressRequest::with('press_request')->get();
        // dd($fill_press_requests);
        return view('production.index',compact('fill_press_requests'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Production $production)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Production $production)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Production $production)
    {
        //
    }
}
