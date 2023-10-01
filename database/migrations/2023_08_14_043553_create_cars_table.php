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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->nullable();
            $table->decimal('weight_empty', 15, 2)->nullable()->default(0);
            $table->decimal('weight_product', 15, 2)->nullable()->default(0);
            // $table->string('recent_car_content')->nullable();
            $table->string('sku', 60)->nullable();
            $table->string('status')->nullable()->default(0);
            $table->string('recent_place', 60)->nullable();
            $table->string('next_place', 60)->nullable();
			$table->string('shipment_number')->nullable();

            $table->integer('color_id')->nullable()->constrained('colors', 'id')->cascadeOnDelete();
            $table->integer('fill_id')->nullable()->constrained('fills', 'id')->cascadeOnDelete();
            $table->integer('type_id')->nullable()->constrained('types', 'id')->cascadeOnDelete();
			$table->string('batch_number')->nullable();
            // $table->foreignId('employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            // $table->foreignId('next_employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            // $table->foreignId('store_id')->nullable()->constrained('stores', 'id')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches', 'id')->cascadeOnDelete();
            // $table->foreignId('caliber_id')->nullable()->constrained('calibers', 'id')->cascadeOnDelete();
            $table->string('process',60)->nullable()->default('not_used');
            $table->string('next_process',60)->nullable()->default('not_used');
            $table->string('used_cart')->nullable()->default('not_used');
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
        Schema::dropIfExists('cars');
    }
};
