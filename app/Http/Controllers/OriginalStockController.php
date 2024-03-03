<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Nationality;
use App\Models\Store;
use App\Models\Supplier;
use Illuminate\Http\Request;

class OriginalStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('original_stock.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('original_stock.create');
    }
    public function create_from_another_store(Request $request)
    {
        $pressing = FillPressRequest::with('press_request')->get();
        $batch_number=Str::random(8);
        return view('original_stock.create_from_store')->with(compact(
            'batch_number'
        ));
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
        //
    }
}
