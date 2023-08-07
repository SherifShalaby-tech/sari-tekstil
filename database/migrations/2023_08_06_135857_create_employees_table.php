<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->constrained('users', 'id')->cascadeOnDelete();;
			$table->string('password')->nullable();
			$table->string('name');
			$table->date('date_of_start_working')->nullable();
			$table->integer('job_type_id')->unsigned()->nullable();
			$table->string('phone')->nullable();
			$table->date('date_of_birth')->nullable();
			$table->integer('annual_leave_per_year')->nullable();
			$table->integer('sick_leave_per_year')->nullable();
			$table->enum('payment_cycle', array('daily', 'weekly', 'monthly'))->nullable();
			$table->tinyInteger('commission')->nullable();
			$table->decimal('commission_value', 10,2)->nullable();
			$table->enum('commission_type', array('profit_sales'))->nullable();
			$table->enum('commision_calculation_period', array('daily', 'weekly', 'one_month', 'three_month'))->nullable();
			$table->text('comissioned_products')->nullable();
			$table->text('comission_customer_types')->nullable();
			$table->text('comission_stores')->nullable();
			$table->text('comission_cashier')->nullable();
			$table->string('working_day_per_weak')->nullable();
			$table->string('check_in')->nullable();
			$table->string('check_out')->nullable();
            $table->integer('number_of_days_any_leave_added')->nullable();
            $table->string('working_day_per_week')->nullable();
			$table->boolean('fixed_wage')->default('0');
            $table->decimal('fixed_wage_value')->default('0');
            $table->string('photo')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('edited_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->softDeletes();
			$table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
