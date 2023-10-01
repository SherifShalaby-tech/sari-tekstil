<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarExtra extends Model
{
    use HasFactory;
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'car_extras';

    public function car()
    {
        return $this->belongsTo(Cars::class,'cars_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function next_employee()
    {
        return $this->belongsTo(Employee::class, 'next_employee_id');
    }
    public function caliber()
    {
        return $this->belongsTo(Caliber::class, 'caliber_id');
    }

    
}
