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
        Schema::create('original_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('source', 60)->nullable();
            $table->string('shipment_number')->nullable();
            $table->decimal('shipment_weight', 15, 4)->nullable();
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities', 'id')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers', 'id')->cascadeOnDelete();
            $table->foreignId('lab_id')->nullable()->constrained('labs', 'id')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches', 'id')->cascadeOnDelete();
            $table->foreignId('store_id')->nullable()->constrained('stores', 'id')->cascadeOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('types', 'id')->cascadeOnDelete();
            $table->decimal('actual_weight', 15, 4)->nullable();
            $table->decimal('total_weight', 15, 4)->nullable();
            $table->decimal('wet_weight', 15, 4)->nullable();
            $table->decimal('dry_weight', 15, 4)->nullable();
            $table->decimal('price', 15, 4)->nullable();
            $table->decimal('shipping_cost', 15, 4)->nullable();
            $table->decimal('clearance_cost', 15, 4)->nullable();
            $table->decimal('internal_transport_cost', 15, 4)->nullable();
            $table->decimal('internal_load_cost', 15, 4)->nullable();
            $table->decimal('fines', 15, 4)->nullable();
            $table->json('other_costs')->nullable();
            $table->decimal('price_per_kilo', 15, 4)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('shipment_name')->nullable();
            $table->text('files')->nullable();
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
        Schema::dropIfExists('original_stocks');
    }
};
