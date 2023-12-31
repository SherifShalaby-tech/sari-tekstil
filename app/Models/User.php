<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles,HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function employees()
    {
        return $this->hasOne(Employee::class,'user_id');
    }
    public static function modulePermissionArray()
    {
        return [
            'dashboard' => __('lang.dashboard'),
            'customers_module' => __('lang.customers'),
            'employees_module' => __('lang.employees'),
            'suppliers_module' => __('lang.suppliers'),
            'settings_module' => __('lang.settings'),
            'reports_module' => __('lang.reports'),
        ];
    }

    public function scopeNotview($query)
    {
        return $query->where('email', '!=', env( 'SYSTEM_SUPERADMIN','superadmin@sherifshalaby.tech'));
    }
    public static function subModulePermissionArray()
    {
        return [
            'dashboard' ,
            'customers_module' => [
                'customer' => __('lang.customers'),
                'customer_type' => __('lang.customer_types'),
                'add_payment' => __('lang.add_payment'),
            ],
            'suppliers_module' => [
                'supplier' => __('lang.suppliers'),
            ],
            'employees_module' => [
                'employee' => __('lang.employees'),
                'employee_commission' => __('lang.employee_commission'),
                'jobs' => __('lang.jobs'),
                'leave_types' => __('lang.leave_types'),
                'leaves' => __('lang.leaves'),
                'attendance' => __('lang.attendance'),
                'wages' => __('lang.wages'),
                'forfeit_leaves' => __('lang.forfeit_leaves'),
            ],
            'reports_module' => [
                'profit_loss' => __('lang.profit_loss'),
                'daily_sales_summary' => __('lang.daily_sales_summary'),
                'receivable_report' => __('lang.receivable_report'),
                'payable_report' => __('lang.payable_report'),
                'expected_receivable_report' => __('lang.expected_receivable_report'),
                'expected_payable_report' => __('lang.expected_payable_report'),
                'summary_report' => __('lang.summary_report'),
                'sales_per_employee' => __('lang.sales_per_employee'),
                'best_seller_report' => __('lang.best_seller_report'),
                'sale_report' => __('lang.sale_report'),
                'purchase_report' => __('lang.purchase_report'),
                'store_report' => __('lang.store_report'),
                'store_stock_chart' => __('lang.store_stock_chart'),
                'user_report' => __('lang.user_report'),
                'customer_report' => __('lang.customer_report'),
                'supplier_report' => __('lang.supplier_report'),
                'due_report' => __('lang.due_report'),
            ],
            'settings_module' => [
                'modules' => __('lang.modules'),
                'general_settings' => __('lang.general_settings'),
                'nationalities' => __('lang.nationalities'),
                'fills' => __('lang.fills'),
                'types' => __('lang.types'),
                'colors' => __('lang.colors'),
                'cars' => __('lang.cars'),
                //
                'money_safe' => __('lang.money_safe'),
                'add_money_to_safe' => __('lang.add_moneysafe'),
                'take_money_from_safe' => __('lang.take_money_safe'),
                'statement' => __('lang.statement'),
                //
                'add_cash_in' => __('lang.add_cash_in'),
                'add_closing_cash' => __('lang.add_closing_cash'),
                'add_cash_out' => __('lang.add_cash_out'),
                'view_details' => __('lang.view_details'),
                //
                'sales_promotion' => __('lang.sales_promotion'),
            ],
            
        ];
    }
    public static function subModuleEmployeePermissionArray()
    {
        return [
            'admin' => 'admin',
            'orignal_store_worker' => 'orignal_store_worker',
            'transporter' => 'transporter',
            'conquest_factor' => 'conquest_factor',
            'sort_worker' => 'sort_worker',
            'cream_sorting_worker' => 'cream_sorting_worker',
            'extra_sorting_worker' => 'extra_sorting_worker',
            'compression_worker' => 'compression_worker',
        ];
    }

}
