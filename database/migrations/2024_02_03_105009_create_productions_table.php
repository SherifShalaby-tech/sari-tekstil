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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            // Foreign Key : fill_press_request_id
            $table->foreignId('fill_press_request_id')->references('id')->on('fill_press_requests')->onDelete('cascade');
            $table->string('association_number');
            $table->string('delivery_number');
            $table->string('operating_number');
            $table->string('packing_type');
            $table->string('current_location');
            $table->string('weight');
            $table->date('production_date');
            // Foreign Key : last_worker
            $table->foreignId('last_worker')->references('id')->on('users')->onDelete('cascade');
            $table->integer('cost_per_unit');
            $table->string('original_content');
            $table->string('current_content');
            $table->integer('caliber');
            // Foreign Key : color_id
            $table->foreignId('color_id')->nullable()->constrained('colors', 'id')->cascadeOnDelete();
            $table->string('quantity');
            $table->integer('total_cost');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
