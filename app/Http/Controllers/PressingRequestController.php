<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PressingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fillingRequests=FillingRequest::latest()->get();
        return view('admin.filling_request_index',compact('fillingRequests'));
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
        return view('admin.filling_request_create')->with(compact(
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
            $data = $request->except('_token');
            $data['created_by']=Auth::user()->id;
            $filling_request = FillingRequest::create($data);

            $indexs=[];
            if($request->has('nationality_id')){
                if(count($request->nationality_id)>0){
                    $indexs=array_keys($request->nationality_id);
                }
            }
            foreach ($indexs as $index){
                $items=[
                    'opening_request_id' => $filling_request->id,
                    'nationality_id' => $request->nationality_id[$index],
                    'percent' => $request->percent[$index],
                    'weight' => $request->weight[$index],
                ];
                FillingRequest::create($items);
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

    public function addPressingRow(){
        $fills = Fill::pluck('name', 'id');
        $screening = Screening::pluck('name', 'id');
        $calibers=Caliber::pluck('number');
        $employees=Employee::pluck('name', 'id');
        $colors=Color::pluck('name', 'id');
        $hideBtn=0;
        $weight_product='';
        // return "Hello from addNationalityRow";
        return view('admin.partials.add_nationalities',compact('fills',
        'screening',
        'calibers',
        'employees',
        'colors','hideBtn'));
    }
}
