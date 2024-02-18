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
        Schema::create('pressing_request_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('source')->nullable();
            $table->integer('priority')->nullable();
            $table->string('status')->nullable()->default('0');
            $table->timestamps();
        });
        Schema::table('pressing_requests', function (Blueprint $table) {
            $table->foreignId('pressing_request_transaction_id')->nullable()->constrained('pressing_request_transactions', 'id')->cascadeOnDelete();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pressing_request_transactions');
    }
};
