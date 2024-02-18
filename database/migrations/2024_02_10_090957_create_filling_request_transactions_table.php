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
        Schema::create('filling_request_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('source', 60)->nullable();
            $table->integer('priority')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->nullable()->default('0');
            $table->timestamps();
        });
        Schema::table('filling_requests', function (Blueprint $table) {
            $table->foreignId('filling_request_transaction_id')->nullable()->constrained('filling_request_transactions', 'id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filling_request_transactions');
    }
};
