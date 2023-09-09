<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FillingByOriginalStore extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = ['workers' => 'array'];
    public function filling_by_original_store_nationalities()
    {
        return $this->hasMany(FillingByOriginalStoreNationality::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id')->withDefault(['employee', '']);
    }
    public function car()
    {
        return $this->belongsTo(Cars::class,'car_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
    public function car_contents()
    {
        return $this->hasMany(CarContents::class, 'id');
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
