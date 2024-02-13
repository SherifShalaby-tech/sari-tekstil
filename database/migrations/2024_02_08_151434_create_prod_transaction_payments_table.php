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
        Schema::create('prod_transaction_payments', function (Blueprint $table) {
            $table->id();
            // +++++ Foreign key : production_transaction_id +++++
            $table->unsignedBigInteger('production_transaction_id')->nullable();
            $table->foreign('production_transaction_id')->references('id')->on('production_transactions')->onDelete('cascade');
            // +++++ Foreign key : customer_id +++++
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // the "amount" that "customer" must pay
            $table->decimal('amount', 15, 4)->nullable();
            // the "amount" that "customer paid"
            $table->decimal('customer_paid', 15, 4)->nullable();
            // the "total amount" that "customer" must pay
            $table->decimal('sum_total_cost', 15, 4)->nullable();
            $table->enum('payment_status', ['paid', 'pending', 'partial'])->nullable();
            $table->enum('payment_type', ['cash', 'visa'])->nullable();
            $table->string('payment_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('edited_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_transaction_payments');
    }
};
