<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()
        ->get();

    return view('employees.attendance.index')->with(compact(
        'attendances'
    ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::whereNotNull('user_id')->pluck('name', 'id');
        return view('employees.attendance.create')->with(compact(
            'employees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $attendances = $request->attendances;
            foreach ($attendances as $attendance) {
                $data = [
                    'date' => $attendance['date'],
                    'employee_id' => $attendance['employee_id'],
                    'check_in' => $attendance['check_in'],
                    'check_out' => $attendance['check_out'],
                    'status' => $attendance['status'],
                    'created_by' => Auth::user()->id
                ];

                if ($attendance['status'] == 'on_leave') {
                    $employee = Employee::find($attendance['employee_id']);
                    $employee->number_of_days_any_leave_added = $employee->number_of_days_any_leave_added + 1;
                    $employee->save();
                }

                Attendance::create($data);
            }

            $output = [
                'success' => true,
                'msg' => __('lang.attendance_added')
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
        try {
            $attendance=Attendance::find($id);
            $attendance->deleted_by=Auth::user()->id;
            $attendance->save();
            $attendance->delete();
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
    public function getAttendanceRow($row_index)
    {
        $employees = Employee::whereNotNull('user_id')->pluck('name', 'id');

        return view('employees.attendance.attendance_row')->with(compact(
            'employees',
            'row_index'
        ));
    }
}
