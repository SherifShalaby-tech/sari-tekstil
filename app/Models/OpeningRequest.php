<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningRequest extends Model
{
    use HasFactory ,SoftDeletes;
    protected $guarded = ['id'];
    public function opening_request_nationalities()
    {
        return $this->hasMany(OpeningRequestNationality::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
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
