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
        Schema::create('production_transactions', function (Blueprint $table) {
            $table->id();
            // +++++ Foreign key : store_id +++++
			$table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            // +++++ Foreign key : employee_id +++++
            $table->unsignedBigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
            // +++++ Foreign key : customer_id +++++
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // +++++ type +++++
            $table->string('type')->nullable();
            $table->decimal('grand_total', 15, 4)->nullable();
            $table->decimal('final_total', 15, 4)->default(0.0000);
            $table->string('transaction_date');
            $table->enum('payment_status', ['paid', 'pending', 'partial'])->nullable();
            // +++++ Foreign key : created_by +++++
			$table->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            // +++++ Foreign key : edited_by +++++
            $table->foreignId('edited_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            // +++++ Foreign key : deleted_by +++++
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
        Schema::dropIfExists('production_transactions');
    }
};
