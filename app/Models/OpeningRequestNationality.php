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
    public function opening_request()
    {
        return $this->belongsTo(OpeningRequest::class,'opening_request_id');
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
