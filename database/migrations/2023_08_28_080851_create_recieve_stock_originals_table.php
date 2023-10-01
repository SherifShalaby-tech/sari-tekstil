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
        Schema::create('recieve_stock_originals', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->constrained('employees', 'id')->cascadeOnDelete();
            $table->integer('original_stock_id')->constrained('original_stocks', 'id')->cascadeOnDelete();
			$table->string('recent_weight')->nullable();
			$table->string('process')->nullable();
			$table->string('status')->nullable()->default(1);
            $table->integer('color_id')->constrained('colors', 'id')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recieve_stock_originals');
    }
};
