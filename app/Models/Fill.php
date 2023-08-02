<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fill extends Model
{
    protected $guarded = ['id'];
    protected $table = 'fills';

    public function createBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
