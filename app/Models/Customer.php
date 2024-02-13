<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'customers';
    // protected $casts = ['phones' => 'array','emails' => 'array'];
    public function user()
    {
        return $this->belongsTo(User::class, 'responsable_id');
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
