<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVacationTypeRequest;
use App\Http\Requests\VacationTypeRequest;
use App\Models\LeaveType;
use App\Models\VacationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VacationTypeController extends Controller
{
    public function index()
    {
        $leave_types=LeaveType::latest()->get();
        return view('employees.leave_types.index',compact('leave_types'));
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
    public function store(VacationTypeRequest $request)
    {
        try {
            $data = $request->except('_token');
            $data['created_by']=Auth::user()->id;
            $vacation_type = LeaveType::create($data);
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
        $leave_type = LeaveType::find($id);
        return view('employees.leave_types.edit')->with(compact(
            'leave_type'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacationTypeRequest $request, string $id)
    {
        try {
            $data = $request->except('_token');
            $data['edited_by'] = Auth::user()->id;
            LeaveType::find($id)->update($data);
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
            $vacation_type=LeaveType::find($id);
            $vacation_type->deleted_by=Auth::user()->id;
            $vacation_type->save();
            $vacation_type->delete();
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

