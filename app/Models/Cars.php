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
    // protected $casts = ['employee_id' => 'array',
    // 'caliber_id' => 'array',
    // 'next_employee_id' => 'array',
    // ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function fills()
    {
        return $this->belongsTo(Fill::class, 'fill_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function caliber()
    {
        return $this->belongsTo(Caliber::class, 'caliber_id');
    }
    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'employee_id');
    // }
    // public function next_employee()
    // {
    //     return $this->belongsTo(Employee::class, 'next_employee_id');
    // }
    public function car_extras()
    {
        return $this->hasMany(CarExtra::class);
    }
    
    public function car_contents()
    {
        return $this->hasMany(CarContents::class, 'id');
    }
    
    public function expense_car()
    {
        return $this->hasOne(ExpenseCar::class,'car_id');
    }
    public function filling_by_original_stores()
    {
        return $this->hasMany(FillingByOriginalStore::class,'id');
    }

    public function opening_request_nationalities()
    {
        return $this->hasMany(OpeningRequestNationality::class,'id');
    }
    public function car_content()
    {
        return $this->hasMany(CarContent::class,'id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
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
            'sort' => __('lang.extra_sort'),
            'cream_sort' => __('lang.cream_sort'),
            'cream_sort' => __('lang.filling'),
            'not_used' => __('lang.not_used'),
        ];
    }
}
