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
        Schema::table('screenings', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->string('season')->nullable();
            $table->string('cost')->nullable();
            $table->string('sell_price')->nullable();
            $table->json('calibers')->nullable()->constrained('calibers', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            //
        });
    }
};
