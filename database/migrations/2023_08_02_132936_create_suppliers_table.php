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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('responsable_id', 60)->constrained('users', 'id')->cascadeOnDelete();
            $table->string('country', 60)->nullable();
            $table->text('phones')->nullable();
            $table->string('email', 60)->nullable();
            $table->decimal('total_purchases',15,2)->default(0)->nullable();
            $table->decimal('total_debt',15,2)->default(0)->nullable();
            $table->string('bank_name', 60)->nullable();
            $table->string('iban', 60)->nullable();
            $table->string('currency_id', 60)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
