<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cars extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'cars';

    // public function store()
    // {
    //     return $this->belongsTo(Store::class, 'store_id');
    // }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function caliber()
    {
        return $this->belongsTo(Caliber::class, 'caliber_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function next_employee()
    {
        return $this->belongsTo(Employee::class, 'next_employee_id');
    }
    public function expense_car()
    {
        return $this->hasOne(ExpenseCar::class,'car_id');
    }
    public function createBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
    public static function getProcesses()
    {
        return [
            'original_store' => __('lang.original_store'),
            'openning' => __('lang.openning'),
            'squeeze' => __('lang.squeeze'),
            'sort' => __('lang.sort'),
            'cream_sort' => __('lang.cream_sort'),
            'not_used' => __('lang.not_used'),
        ];
    }
}
