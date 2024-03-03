<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = true;
    // soft delete
    protected $dates = ['deleted_at'];

    // +++++++++++++++++ transaction_purchase_order_line() Relationship +++++++++++++++++
    public function transaction_production()
    {
        return $this->hasMany(ProductionTransaction::class);
    }
    // +++++++++++++++++ transaction_payments() Relationship +++++++++++++++++
    public function transaction_payments()
    {
        return $this->hasMany(ProductionTransactionPayment::class,'production_transaction_id','id');
    }
    // +++++++++++++++++ customer() Relationship +++++++++++++++++
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withDefault(['name' => '']);
    }

    // +++++++++++++++++ store() Relationship +++++++++++++++++
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id')->withDefault(['name' => '']);
    }
    // +++++++++++++++++ production() Relationship +++++++++++++++++
    public function production()
    {
        return $this->belongsTo(Production::class);
    }
    // +++++++++++++++++ created_by_user() Relationship +++++++++++++++++
    public function created_by_user()
    {
        // return $this->belongsTo(User::class, 'created_by', 'id');
        return $this->belongsTo(User::class,'created_by');
    }
}
