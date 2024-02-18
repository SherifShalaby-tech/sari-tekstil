<?php

namespace App\Http\Controllers;

use App\Models\FillPressRequest;
use App\Models\PressingRequest;
use App\Models\System;
use Illuminate\Http\Request;

class SqueezeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('workers.compression.comprssion_request_from_admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $pressing_request=PressingRequest::find($id);
        return view('workers.compression.comprssion_request_from_admin.create',compact('pressing_request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function printBaleStaker($bale_id)
    {
        $invoice_lang = System::getProperty('invoice_lang');
        if (empty($invoice_lang)) {
            $invoice_lang = request()->session()->get('language');
        }
        $bale=FillPressRequest::find($bale_id);
        return $html_content = view('workers.compression.comprssion_request_from_admin.bale_staker')->with(compact(
            'bale',
            'invoice_lang',
        ))->render();
    }
}
