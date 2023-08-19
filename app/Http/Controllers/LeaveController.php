<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::
        when(\request()->start_date != null, function ($query) {
            $query->where('start_date',\request()->start_date);
        })
        ->when(\request()->end_date != null, function ($query) {
            $query->where('end_date',\request()->end_date);
        })
        ->latest()->get();

    $employees =  Employee::orderBy('name', 'asc')->pluck('name', 'id');
    $this_employee = Employee::where('user_id', Auth()->user()->id)->first();
    $this_employee_id = null;
    if (!empty($this_employee)) {
        $this_employee_id = $this_employee->id;
    }
    if (!empty(request()->employee_id)) {
        //using from employee list page
        $this_employee_id = request()->employee_id;
    }
    $leave_types = LeaveType::orderBy('name', 'asc')->pluck('name', 'id');
    return view('employees.leaves.index')->with(compact(
        'leaves','leave_types','employees','this_employee_id'
    ));
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
        try {
            $data = $request->except('_token');
            $data['number_of_days'] = Carbon::parse($data['start_date'])->diff(Carbon::parse($data['end_date']))->format('%d') + 1;
            $data['status'] = 'pending';
            $data['created_by'] = Auth::user()->id;

            if ($request->hasFile('upload_files')) {
                $files=[];
                for ($i=0;$i<count($request->upload_files);$i++) {
                    $image= $request->upload_files[$i];
                    $ext = $image->getClientOriginalExtension();
                    $filename = rand(1111,9999).time() . '.' . $ext;
                    $image->move("uploads/employees/", $filename);
                    $files[]= $filename;
                }
                $data['files']=$files;
            }
            $leave = Leave::create($data);

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
        $leave = Leave::find($id);
        $employees =  Employee::orderBy('name', 'asc')->pluck('name', 'id');
        $leave_types = LeaveType::orderBy('name', 'asc')->pluck('name', 'id');
        return view('employees.leaves.edit')->with(compact(
            'leave','leave_types','employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->except('_token', '_method');
            $data['number_of_days'] = Carbon::parse($data['start_date'])->diff(Carbon::parse($data['end_date']))->format('%d') + 1;
            $data['edited_by'] = Auth::user()->id;
            $leave = Leave::find($id);
          
            if ($request->hasFile('upload_files')) {
                if(!empty($leave->files)){
                    for ($i=0;$i<count($leave->files);$i++) {
                        $image= $leave->files[$i];
                        $fullPath = public_path('uploads/employees/' .$image);
                        File::delete($fullPath);
                    }
                }
                $files=[];
                for ($i=0;$i<count($request->upload_files);$i++) {
                    $image= $request->upload_files[$i];
                    $ext = $image->getClientOriginalExtension();
                    $filename = rand(1111,9999).time() . '.' . $ext;
                    $image->move("uploads/employees/", $filename);
                    $files[]= $filename;
                }
                $data['files']=$files;
            }
            $leave->update($data);
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
            $leave=Leave::where('id', $id);
            $leave->deleted_by=Auth::user()->id;
            $leave->delete();
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
