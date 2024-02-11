<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PressingRequest extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'pressing_requests';

    protected $casts = [ 'calibers' => 'array' ];
    public function filling()
    {
        return $this->belongsTo(Fill::class, 'filling_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function screening()
    {
        return $this->belongsTo(Screening::class, 'screening_id');
    }
    public function pressing_request_transactions(){
        return $this->belongsTo(PressingRequestTransaction::class, 'pressing_request_transaction_id');
    }
}
