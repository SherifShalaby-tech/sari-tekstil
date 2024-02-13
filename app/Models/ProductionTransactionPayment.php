<?php

namespace App\Models;

use App\Models\ProductionTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionTransactionPayment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $table = "prod_transaction_payments";

    // ++++++++++++++++++ wages_transaction_payments +++++++++++++++
    public function production_transaction()
    {
        return $this->belongsTo(ProductionTransaction::class);
    }
}
