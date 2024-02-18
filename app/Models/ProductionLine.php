<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLine extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;

    public function transaction()
    {
        return $this->belongsTo(ProductionTransaction::class,'purchase_order_transaction_id');
    }
    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
