<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fill_press_requests', function (Blueprint $table) {
            $table->decimal('packing_tape_required', 8, 2)
                    ->default(0)->after('weight');
        });
    }

    public function down()
    {
        Schema::table('fill_press_requests', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
};
