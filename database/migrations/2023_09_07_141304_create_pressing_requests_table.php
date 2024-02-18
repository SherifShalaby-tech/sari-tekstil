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
        Schema::create('pressing_requests', function (Blueprint $table) {
            $table->id();
            $table->string('required')->nullable();
            $table->foreignId('screening_id')->nullable()->constrained('screenings', 'id')->cascadeOnDelete();
            $table->decimal('empty_weight', 15, 2)->nullable(); 
            $table->decimal('weight', 15, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('destination')->nullable();
            $table->text('calibers')->nullable();
            // $table->integer('priority')->nullable();
            // $table->string('status')->nullable()->default('0');
            $table->foreignId('color_id')->nullable()->constrained('colors', 'id')->cascadeOnDelete();
            $table->foreignId('filling_id')->nullable()->constrained('fills', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('pressing_requests');
    }
};
