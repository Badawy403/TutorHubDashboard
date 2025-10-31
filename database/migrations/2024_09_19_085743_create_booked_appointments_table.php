<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_appointments', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->integer('id', true);
            $table->integer('student_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('academy_id')->nullable();
            $table->string('date', 155);
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('fee')->nullable();
            $table->tinyInteger('is_paid')->default(0);
            $table->integer('fund_id')->nullable();
            $table->integer('appointment_type_id')->nullable();
            $table->longText('question')->nullable();
            $table->string('attachment_url')->nullable();
            $table->integer('appointment_status_code')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booked_appointments');
    }
};
