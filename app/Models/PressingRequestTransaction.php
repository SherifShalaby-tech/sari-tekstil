<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressingRequestTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pressing_request_transactions';
    public function pressing_requests(){
        return $this->hasMany(PressingRequest::class);
    }
    
}
