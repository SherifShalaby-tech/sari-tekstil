<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Nationality;
use App\Models\OpeningRequest;
use App\Models\OpeningRequestNationality;
use App\Models\OriginalStock;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class AdminRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $opiningRequests=OpeningRequest::latest()->get();
        return view('admin.original_opening_request_index',compact('opiningRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nationalities = Nationality::pluck('name', 'id');
        $types = Type::pluck('name', 'id');
        $batch_number=Str::random(8);
        return view('admin.original_opening_request')->with(compact(
            'nationalities',
            'types',
            'batch_number'
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
            $opening_request = OpeningRequest::create($data);

            $indexs=[];
            if($request->has('nationality_id')){
                if(count($request->nationality_id)>0){
                    $indexs=array_keys($request->nationality_id);
                }
            }
            foreach ($indexs as $index){
                $items=[
                    'opening_request_id' => $opening_request->id,
                    'nationality_id' => $request->nationality_id[$index],
                    'percent' => $request->percent[$index],
                    'weight' => $request->weight[$index],
                ];
                OpeningRequestNationality::create($items);
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

    public function getWeight($id)
    {
        // Replace this with your actual logic to fetch the weight based on the nationality ID
        $weight = OriginalStock::where('nationality_id',$id)->sum('total_weight');

        return response()->json(['weight' => $weight]);
    }

    public function addNationalityRow(){
        $nationalities=Nationality::latest()->pluck('name','id');
        $hideBtn=0;
        $weight_product='';
        // return "Hello from addNationalityRow";
        return view('admin.partials.add_nationalities',compact('nationalities','hideBtn'));
    }

}
