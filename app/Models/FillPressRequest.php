<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillPressRequest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function car()
    {
        return $this->belongsTo(Cars::class, 'cars_id');
    }
    public function press_request()
    {
        return $this->belongsTo(PressingRequest::class, 'press_request_id');
    }
    
}
