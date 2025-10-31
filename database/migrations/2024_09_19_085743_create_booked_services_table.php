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
        Schema::create('booked_services', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->integer('id', true);
            $table->integer('student_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('academy_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->string('date', 155);
            $table->float('price', 10, 0)->nullable();
            $table->tinyInteger('is_paid')->default(0);
            $table->integer('fund_id')->nullable();
            $table->longText('question')->nullable();
            $table->string('attachment_url')->nullable();
            $table->integer('service_status_code')->nullable();
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
        Schema::dropIfExists('booked_services');
    }
};
