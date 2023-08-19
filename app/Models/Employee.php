<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{  
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'employees';
    protected $casts = [
        'working_day_per_week' => 'array',
        // 'store_id' => 'array',
        'check_in' => 'array',
        'check_out' => 'array',
        'files' => 'array',
        'commission_customer_types' => 'array',
        // 'commission_stores' => 'array',
        'comission_cashier' => 'array'

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function createBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
    public function job_type()
    {
        return $this->belongsTo(Job::class, 'job_type_id');
    }
    public static function getWeekDays(){
        return [
            'sunday' => __('lang.sunday'),
            'monday' => __('lang.monday'),
            'tuesday' => __('lang.tuesday'),
            'wednesday' => __('lang.wednesday'),
            'thursday' => __('lang.thursday'),
            'friday' => __('lang.friday'),
            'saturday' => __('lang.saturday'),
        ];
    }
    public static function paymentCycle()
    {
        return [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly'
        ];
    }
    public static function commissionType()
    {
        return [
            'sales' => 'Sales',
            'profit' => 'Profit'
        ];
    }
    public static function commissionCalculationPeriod()
    {
        return [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'one_month' => 'One Month',
            'three_month' => 'Three Month',
            'six_month' => 'Six Month',
            'one_year' => 'One Year',
        ];
    }
    public static function getDropdownByJobType($job_type, $include_superadmin = false, $return_user_id = false)
    {
        $query = Employee::with('job_type', 'user')
            ->whereHas('job_type', function ($query) use ($job_type) {
                $query->where('title', $job_type);
            })->get();
        if ($include_superadmin) {
            $query->orWhere('is_superadmin', 1);
        }
        if ($return_user_id) {
            $employees = $query->pluck('user.name', 'user.id');
        } else {
            $employees = $query->pluck('user.name', 'id');
        }
        return $employees->toArray();
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public static function getBalanceLeave($id)
    {
        $employee = Employee::find($id);

        $leave_balance = 0;
        $worked_months = Employee::getWorkedMonth($employee);

        $per_month_leaves = Employee::getEmployeeLeaveTotal($id) / 12;
        $deserving_leaves_till_date = $per_month_leaves * $worked_months;

        $leave_taken = Leave::whereDate('start_date', '<=', \Carbon\Carbon::now())->where('employee_id', $id)->where('status', 'approved')->sum('number_of_days');
        $leave_balance = $deserving_leaves_till_date - $leave_taken;
        //leave taken from attendance
        $leave_taken_from_attendance = 0;
        if (!empty($employee->date_of_start_working)) {
            $leave_taken_from_attendance = Attendance::where('employee_id', $employee->id)->where('status', 'on_leave')->whereDate('date', '>=', $employee->date_of_start_working)->whereDate('date', '<=', date('Y-m-d'))->count();
        } else {
            $leave_taken_from_attendance = Attendance::where('employee_id', $employee->id)->where('status', 'on_leave')->whereDate('date', '<=', date('Y-m-d'))->count();
        }

        $leave_balance = $leave_balance - $leave_taken_from_attendance;

        // $forfeit_leaves = ForfeitLeave::where('employee_id', $id)->where('start_date', Carbon::now()->format('Y'))->sum('number_of_days');
        // $leave_balance = $leave_balance - $forfeit_leaves;

        return number_format($leave_balance, 2);
    }

    public static function getBalanceLeaveByLeaveType($employee_id, $id)
    {
        $employee = Employee::find($employee_id);

        $leave_balance = 0;
        $worked_months = Employee::getWorkedMonth($employee);

        $per_month_leaves = Employee::getEmployeeLeaveTotalByLeaveType($employee_id, $id) / 12;
        $deserving_leaves_till_date = $per_month_leaves * $worked_months;

        $leave_taken = Leave::whereDate('start_date', '<=', \Carbon\Carbon::now())->where('employee_id', $employee_id)->where('leave_type_id', $id)->where('status', 'approved')->sum('number_of_days');

        $leave_balance = $deserving_leaves_till_date - $leave_taken;
        //leave taken from attendance
        $leave_taken_from_attendance = 0;
        if (!empty($employee->date_of_start_working)) {
            $leave_taken_from_attendance = Attendance::where('employee_id', $employee->id)->where('status', 'on_leave')->whereDate('date', '>=', $employee->date_of_start_working)->whereDate('date', '<=', date('Y-m-d'))->count();
        } else {
            $leave_taken_from_attendance = Attendance::where('employee_id', $employee->id)->where('status', 'on_leave')->whereDate('date', '<=', date('Y-m-d'))->count();
        }

        $leave_balance = $leave_balance - $leave_taken_from_attendance;

        // $forfeit_leaves = ForfeitLeave::where('employee_id', $employee_id)->where('leave_type_id', $id)->where('start_date', Carbon::now()->format('Y'))->sum('number_of_days');
        // $leave_balance = $leave_balance - $forfeit_leaves;

        return number_format($leave_balance, 2);
    }

    public static function getWorkedMonth($employee)
    {
        $worked_months = 0;
        $this_year = Carbon::now()->format('Y');

        if (!empty($employee->date_of_start_working) && Carbon::parse($this_year . '-01-01')->lt(Carbon::parse($employee->date_of_start_working))) {
            $worked_months = Carbon::parse($employee->date_of_start_working)->diffInMonths(\Carbon\Carbon::now());
        } else {
            $worked_months = Carbon::parse($this_year . '-01-01')->diffInMonths(\Carbon\Carbon::now());
        }

        return $worked_months;
    }
    public static function getEmployeeLeaveTotal($employee_id)
    {
        $number_of_leaves = LeaveType::leftjoin('number_of_leaves', 'leave_types.id', 'number_of_leaves.leave_type_id')
            ->where('number_of_leaves.employee_id', $employee_id)
            ->where('number_of_leaves.enabled', 1)
            ->select('leave_types.id', 'leave_types.name', 'leave_types.number_of_days_per_year as number_of_days', 'number_of_leaves.enabled')
            ->get();


        return $number_of_leaves->sum('number_of_days');
    }
}
