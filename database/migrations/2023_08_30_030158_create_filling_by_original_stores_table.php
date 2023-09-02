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
        Schema::create('filling_by_original_stores', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->constrained('employees', 'id')->cascadeOnDelete();
            $table->integer('type_id')->constrained('types', 'id')->cascadeOnDelete();
            $table->integer('car_id')->constrained('cars', 'id')->cascadeOnDelete();
			$table->string('net_weight')->nullable();
			$table->string('batch_number')->nullable();
			$table->string('process')->nullable();
			$table->text('workers')->nullable();
			$table->string('status')->nullable()->default(1);
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('edited_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filling_by_original_stores');
    }
};
