<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntroductionSheet extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function createBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
    public static function getProcesses()
    {
        return [
            'original_store' => __('lang.original_store'),
            'openning' => __('lang.openning'),
            'squeeze' => __('lang.squeeze'),
            'sort' => __('lang.sort'),
            // 'sort' => __('lang.extra_sort'),
            // 'cream_sort' => __('lang.cream_sort'),
            // 'cream_sort' => __('lang.filling'),
            // 'not_used' => __('lang.not_used'),
        ];
    }

}
