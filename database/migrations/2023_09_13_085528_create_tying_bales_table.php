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
        Schema::create('tying_bales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fill_press_request_id1')->nullable()->constrained('fill_press_requests', 'id')->cascadeOnDelete();
            $table->foreignId('fill_press_request_id2')->nullable()->constrained('fill_press_requests', 'id')->cascadeOnDelete();
            $table->foreignId('fill_press_request_id3')->nullable()->constrained('fill_press_requests', 'id')->cascadeOnDelete();
            $table->foreignId('fill_press_request_id4')->nullable()->constrained('fill_press_requests', 'id')->cascadeOnDelete();
            $table->decimal('full_weight',15,2)->nullable();
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
        Schema::dropIfExists('tying_bales');
    }
};
