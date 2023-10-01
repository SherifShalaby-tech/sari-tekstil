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
        Schema::create('car_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cars_id')->nullable()->constrained('cars', 'id')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            $table->foreignId('next_employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            $table->foreignId('caliber_id')->nullable()->constrained('calibers', 'id')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_extras');
    }
};
