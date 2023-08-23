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
            $table->decimal('weight_empty', 15, 4)->nullable()->default(0);
            $table->decimal('weight_product', 15, 4)->nullable()->default(0);
            $table->string('recent_car_content')->nullable()->default('-');
            $table->string('sku', 60)->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            $table->foreignId('next_employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            // $table->foreignId('store_id')->nullable()->constrained('stores', 'id')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches', 'id')->cascadeOnDelete();
            $table->foreignId('caliber_id')->nullable()->constrained('calibers', 'id')->cascadeOnDelete();
            $table->enum('process',['not_used','open','sort','cream sort','original store','squeeze'])->nullable()->default('not_used');
            $table->enum('next_process',['not_used','open','sort','cream sort','original store','squeeze'])->nullable()->default('not_used');
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
