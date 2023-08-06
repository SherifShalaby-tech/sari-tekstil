<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model 
{

    protected $table = 'currencies';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('code', 'country', 'currency', 'symbol');

    public function money_safe()
    {
        return $this->hasMany('App\Models\MoneySafe');
    }
    public static function getDropdown()
    {
        $currencies = Currency::orderBy('currency', 'asc')->pluck('currency', 'id')->toArray();
        return $currencies;
    }

}