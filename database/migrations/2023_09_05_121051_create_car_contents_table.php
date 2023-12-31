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
        Schema::create('car_contents', function (Blueprint $table) {
            $table->id();
            $table->decimal('percentage', 15, 2)->nullable();   
            $table->decimal('weight', 15, 2)->nullable(); 
            $table->decimal('goods_weight', 15, 2)->nullable();
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities', 'id')->cascadeOnDelete();
            $table->foreignId('car_id')->nullable()->constrained('cars', 'id')->cascadeOnDelete();
			$table->string('status')->nullable()->default(1);
            $table->integer('filling_by_original_store_id')->nullable()->constrained('filling_by_original_storess', 'id')->cascadeOnDelete();
            $table->foreignId('opening_request_id')->nullable()->constrained('opening_request_nationalities', 'id')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('edited_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_contents');
    }
};
