<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            $table->foreignId('leave_type_id')->nullable()->constrained('leave_types', 'id')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('rejoining_date');
            $table->integer('number_of_days');
            $table->enum('paid_or_not_paid', ['paid', 'not_paid']);
            $table->decimal('amount_to_paid')->nullable();
            $table->date('payment_date')->nullable();
            $table->text('details')->nullable();
            $table->text('files')->nullable();
            $table->enum('status', ['pending', 'rejected', 'approved'])->default('pending');
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('edited_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
			$table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
