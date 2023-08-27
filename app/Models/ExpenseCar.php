<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'expense_cars';
    protected $casts = ['files' => 'array'];
    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
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
