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
        Schema::create('filling_by_original_store_nationalities', function (Blueprint $table) {
            $table->id();
            $table->integer('filling_by_original_store_id')->constrained('filling_by_original_storess', 'id')->cascadeOnDelete();
            $table->integer('nationality_id')->constrained('nationalities', 'id')->cascadeOnDelete();
			$table->decimal('percent')->nullable()->default('0');
            $table->decimal('weight')->nullable()->default('0');
            $table->decimal('actual_weight')->nullable()->default('0');
			$table->string('status')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filling_by_original_store_nationalities');
    }
};
