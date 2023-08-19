<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForfeitLeave extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = ['files' => 'array'];
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
