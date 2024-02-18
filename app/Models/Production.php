<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function fill_press_request()
    {
        return $this->hasMany(FillPressRequest::class, 'fill_press_request_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'last_worker');
    }
    public function fills()
    {
        return $this->hasOne(Fill::class, 'id', 'filling_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function calibers ()
    {
        return $this->hasMany(Caliber::class, 'id');
    }

    
}
