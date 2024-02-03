<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FillingRequest extends Model
{
    use HasFactory , SoftDeletes;
    protected $casts = ['calibers' => 'array'];
    public function filling()
    {
        return $this->belongsTo('App\Models\Fill','filling_id');
    }
    public function screening()
    {
        return $this->belongsTo('App\Models\Screening','screening_id');
    }
}
