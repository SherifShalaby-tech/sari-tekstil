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
        Schema::create('introduction_sheets', function (Blueprint $table) {
            $table->id();
            // +++++++++++++ foreign key : car_id +++++++++++++
            $table->foreignId('car_id')->nullable()->references('id')->on('cars')->onDelete('cascade');
            // +++++++++++++ car barcode +++++++++++++
            $table->string('car_sku')->nullable();
            // +++++++++++++ process +++++++++++++
            $table->string('process')->nullable();
            // +++++++++++++ process_type +++++++++++++
            $table->string('process_type')->nullable();
            // +++++++++++++ caliber +++++++++++++
            $table->tinyInteger('caliber')->nullable();
            // +++++++++++++ car_barcode +++++++++++++
            $table->string('car_barcode')->nullable();
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
        Schema::dropIfExists('introduction_sheets');
    }
};
