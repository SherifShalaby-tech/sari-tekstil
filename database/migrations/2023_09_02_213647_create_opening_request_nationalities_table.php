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
        Schema::create('opening_request_nationalities', function (Blueprint $table) {
            $table->id();
            $table->decimal('percentage', 15, 4)->nullable();   
            $table->decimal('weight', 15, 4)->nullable(); 
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities', 'id')->cascadeOnDelete();
            $table->foreignId('opening_request_id')->nullable()->constrained('opening_requests', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('opening_request_nationalities');
    }
};
