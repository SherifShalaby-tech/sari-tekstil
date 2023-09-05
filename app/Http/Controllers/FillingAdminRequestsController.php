<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Employee;
use App\Models\Nationality;
use App\Models\OpeningRequest;
use App\Models\OpeningRequestNationality;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FillingAdminRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $openingrequests=OpeningRequest::orderBy('status')->latest()->get();
        return view('workers.original_stocks.filling_admin_requests.index',compact('openingrequests'));
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
        if (!auth()->user()->can('orignal_store_worker')) {
            abort(403, __('lang.unauthorized_action'));
        }
        $types=Type::latest()->pluck('name','id');
        $nationalities=Nationality::latest()->pluck('name','id');
        $cars=Cars::latest()->pluck('sku','id');
        $opening_requests=OpeningRequest::find($id);
        return view('workers.original_stocks.filling_admin_requests.create',compact('types',
        'nationalities','opening_requests','cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $opening_request=OpeningRequest::find($id);
        $opening_request->status="filled";
        $opening_request->save();
        $indexs=[];
            if($request->has('opening_id')){
                if(count($request->opening_id)>0){
                    $indexs=array_keys($request->opening_id);
                }
            }
            foreach ($indexs as $index){
                OpeningRequestNationality::find($request->opening_id[$index])->update([
                    'goods_weight'=>$request->goods_weight[$index],
                    'car_id'=>$request->car_id[$index],
                ]);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addNationalityRow(Request $request){
        $nationalities=Nationality::latest()->pluck('name','id');
        $hideBtn=1;
        $weight_product='';
        if(isset($request->car_id)){
            $weight_product=Cars::find($request->car_id)->weight_product;
        }
        return view('workers.original_stocks.filling_admin_requests.add_nationalities',compact('nationalities','hideBtn','weight_product'));
    }
}
