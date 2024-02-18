<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillingRequestTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'filling_request_transactions';
    public function filling_requests(){
        return $this->hasMany(FillingRequest::class);
    }
}
