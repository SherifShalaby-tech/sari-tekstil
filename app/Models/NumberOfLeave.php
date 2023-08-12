<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumberOfLeave extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'number_of_leaves';

    protected $dates = ['deleted_at'];

    public function created_by()
    {
        return $this->hasMany(User::class,'id');
    }
    public function updated_by()
    {
        return $this->belongsTo(User::class,'id');
    }
}
