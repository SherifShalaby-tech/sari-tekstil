<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FillingRequest extends Model
{
    use HasFactory , SoftDeletes;
    protected $casts = ['calibers' => 'array'];
    protected $fillable = array('source','filling_id','empty_weight','requested_weight','filling_request_transaction_id',
     'calibers','screening_id','destination','priority','notes','quantity','employee_id','color_id', 'created_by'
    );
    public function fills(){
        return $this->hasOne(Fill::class, 'id', 'filling_id');
    }

    public function calibers (){
        return $this->hasMany(Caliber::class, 'id');
    }
    public function screening()
    {
        return $this->belongsTo(Screening::class, 'screening_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function filling_request_transactions(){
        return $this->belongsTo(FillingRequestTransaction::class, 'filling_request_transaction_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
