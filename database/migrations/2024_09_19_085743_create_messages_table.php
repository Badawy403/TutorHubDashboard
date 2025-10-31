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
        Schema::create('messages', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->integer('id', true);
            $table->longText('message')->nullable();
            $table->integer('appointment_id')->nullable();
            $table->integer('booked_service_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->string('sender_type')->nullable();
            $table->string('reciever_id')->nullable();
            $table->string('reciever_type')->nullable();
            $table->string('attachment_url', 225)->nullable();
            $table->tinyInteger('is_attachment')->default(0);
            $table->tinyInteger('is_seen')->default(0);
            $table->timestamp('seen_at')->nullable();
            $table->tinyInteger('is_delivered')->default(0);
            $table->timestamp('delivered_at')->nullable();
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
        Schema::dropIfExists('messages');
    }
};
