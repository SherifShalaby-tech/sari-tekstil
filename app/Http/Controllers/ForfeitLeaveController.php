<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ForfeitLeave;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForfeitLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forfiets=ForfeitLeave::latest()->get();
        return view('employees.forfeit_leave.index')->with(compact('forfiets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $query = Employee::latest();
        $query->where('user_id', Auth::user()->id);
        $employees =  $query->pluck('name', 'id');

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
    
        return view('employees.forfeit_leave.create')->with(compact(
            'employees',
            'this_employee_id',
            'leave_types'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
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
            $leave = ForfeitLeave::create($data);

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
}
