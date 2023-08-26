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
        Schema::create('expense_cars', function (Blueprint $table) {
            $table->id();
            $table->decimal('cost', 15, 4)->nullable()->default(0);
            $table->foreignId('car_id')->nullable()->constrained('cars', 'id')->cascadeOnDelete();
            $table->date('date_of_creation');
            $table->string('status')->nullable()->default(0);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('expense_cars');
    }
};
