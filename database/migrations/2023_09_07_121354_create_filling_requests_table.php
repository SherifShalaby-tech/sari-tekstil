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
        Schema::create('filling_requests', function (Blueprint $table) {
            $table->id();
            // $table->string('source', 60)->nullable();
            $table->foreignId('filling_id')->nullable()->constrained('fills', 'id')->cascadeOnDelete();
            $table->decimal('empty_weight', 15, 2)->nullable(); 
            $table->decimal('requested_weight', 15, 2)->nullable();
            $table->json('calibers')->nullable()->constrained('calibers', 'id');
            $table->foreignId('screening_id')->nullable()->constrained('screenings', 'id')->cascadeOnDelete();
            $table->string('destination')->nullable();
      
            $table->integer('quantity')->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            $table->foreignId('color_id')->nullable()->constrained('colors', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('filling_requests');
    }
};
