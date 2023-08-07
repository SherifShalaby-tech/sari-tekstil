<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches=Branch::latest()->get();
        return view('branches.index',compact('branches'));
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
        $branches_count=Branch::count();
        if($branches_count < 3){
            try {
                $data = $request->except('_token');
                $data['created_by']=Auth::user()->id;
                $branch = Branch::create($data);
                $output = [
                    'success' => true,
                    'id' => $branch->id,
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
        }else{
            $output = [
                'success' => false,
                'msg' => __('lang.max_branches')
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
        $branch = Branch::find($id);
        return view('branch.edit')->with(compact(
            'branch'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data['name'] = $request->name;
            $data['edited_by'] = Auth::user()->id;
            Branch::find($id)->update($data);
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
            $branch=Branch::find($id);
            $branch->deleted_by=Auth::user()->id;
            $branch->save();
            $branch->delete();
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
