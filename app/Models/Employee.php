<?php

namespace App\Models;

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
}
