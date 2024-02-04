<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FillingRequest extends Model
{
    use HasFactory , SoftDeletes;
    protected $casts = ['calibers' => 'array'];
    protected $fillable = array('source','filling_id','empty_weight','requested_weight',
     'calibers','screening_id','destination','priority','notes','quantity','employee_id','color_id', 'created_by'
    );
    public function fills(){
        return $this->hasOne(Fill::class, 'id', 'filling_id');
    }

    public function calibers (){
        return $this->hasMany(Caliber::class, 'id');
    }
}
