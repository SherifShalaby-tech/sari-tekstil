<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model 
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $casts = ['files' => 'array'];
    public static function getLeaveTypes()
    {
        return [
            'annual_leave' => __('lang.annual_leave'),
            'sick_leave' => __('lang.sick_leave'),
            'maternity_leave' => __('lang.maternity_leave'),
            'other_leave' => __('lang.other_leave')
        ];
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id')->withDefault(['employee', '']);
    }
    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id')->withDefault(['employee', '']);
    }
    public function createBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
