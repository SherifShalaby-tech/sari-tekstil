<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarContents extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'car_contents';

    public function car()
    {
        return $this->hasOne(Cars::class,'car_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }
    public function filling_by_original_stores()
    {
        return $this->belongsTo(FillingByOriginalStore::class,'filling_by_original_store_id');
    }
}
