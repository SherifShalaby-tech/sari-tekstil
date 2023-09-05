<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningRequestNationality extends Model
{
    use HasFactory ,SoftDeletes ;
    protected $guarded = ['id'];
    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }
    public function car()
    {
        return $this->belongsTo(Cars::class,'car_id');
    }
}
