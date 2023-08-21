<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('suppliers_module.supplier.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $suppliers=Supplier::latest()->get();
        $currencies=Currency::getDropdown();
        return view('suppliers.index',compact('suppliers','currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->can('suppliers_module.supplier.create')){
            abort(403, __('lang.unauthorized_action'));
        }
        $users=User::orderBy('created_at', 'desc')->pluck('name','id');
        $currencies  = $this->allCurrencies();
        return view('suppliers.create',compact('users','currencies'));
    }
    public function allCurrencies($exclude_array = [])
    {
        $query = Currency::select('id', DB::raw("concat(country, ' - ',currency, '(', code, ') ', symbol) as info"))
            ->orderBy('country');
        if (!empty($exclude_array)) {
            $query->whereNotIn('id', $exclude_array);
        }

        $currencies = $query->pluck('info', 'id');

        return $currencies;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'max:255|required',
        ]);
        try {
            $data = $request->except('_token');
            $data['created_by'] = Auth::user()->id;
            $s=Supplier::create($data);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
  
        }
        catch (\Exception $e) {
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
        if(!auth()->user()->can('suppliers_module.supplier.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        $users=User::orderBy('created_at', 'desc')->pluck('name','id');
        $currencies  = $this->allCurrencies();
        $supplier=Supplier::find($id);
        return view('suppliers.edit',compact('users','currencies','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!auth()->user()->can('suppliers_module.supplier.delete')){
            abort(403, __('lang.unauthorized_action'));
        }
        try {
            $data = $request->except('_token');
            $data['name'] = $request->name;
            $data['edited_by'] = Auth::user()->id;
            Supplier::find($id)->update($data);
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
            $supplier=Supplier::find($id);
            $supplier->deleted_by=Auth::user()->id;
            $supplier->save();
            $supplier->delete();
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
