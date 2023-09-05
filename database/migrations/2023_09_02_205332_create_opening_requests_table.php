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
        Schema::create('opening_requests', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number')->nullable();
            $table->string('source', 60)->nullable();
            $table->decimal('requested_weight', 15, 2)->nullable();
            $table->integer('shipment_number')->nullable()->constrained('original_stocks', 'shipment_number')->cascadeOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('types', 'id')->cascadeOnDelete();
            $table->string('status')->default('pending');
            $table->integer('priority')->nullable();    
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
        Schema::dropIfExists('opening_requests');
    }
};
