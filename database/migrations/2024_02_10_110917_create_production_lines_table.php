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
        Schema::create('production_lines', function (Blueprint $table) {
            $table->id();
            // foreign key : production_id
            $table->unsignedBigInteger('production_id');
            $table->foreign('production_id')->references('id')->on('productions')->onDelete('cascade');
            // foreign key : production_transaction_id
            $table->unsignedBigInteger('production_transaction_id')->nullable();
            $table->foreign('production_transaction_id')->references('id')->on('production_transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('quantity', 15, 4);
            $table->decimal('sell_price', 15, 4);
            $table->decimal('sub_total', 15, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_lines');
    }
};
