<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TyingBale extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    // protected $casts = ['skus' => 'array'];
    public function fill_press_request1()
    {
        return $this->belongsTo(FillPressRequest::class, 'fill_press_request_id1');
    }
    public function fill_press_request2()
    {
        return $this->belongsTo(FillPressRequest::class, 'fill_press_request_id2');
    }
    public function fill_press_request3()
    {
        return $this->belongsTo(FillPressRequest::class, 'fill_press_request_id3');
    }
    public function fill_press_request4()
    {
        return $this->belongsTo(FillPressRequest::class, 'fill_press_request_id4');
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
