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
        Schema::create('fill_press_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            $table->foreignId('cars_id')->nullable()->constrained('cars', 'id')->cascadeOnDelete();
            $table->foreignId('press_request_id')->nullable()->constrained('pressing_requests', 'id')->cascadeOnDelete();
            $table->string('sku')->nullable();
            $table->decimal('weight', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_press_requests');
    }
};
