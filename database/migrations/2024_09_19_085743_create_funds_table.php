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
        Schema::create('funds', function (Blueprint $table) {
            $table->collation = 'utf8mb4_unicode_ci';
            $table->charset = 'utf8mb4';

            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('gateway_id')->nullable();
            $table->string('gateway_currency', 191)->nullable();
            $table->decimal('amount', 18, 8)->default(0);
            $table->decimal('charge', 18, 8)->default(0);
            $table->decimal('rate', 18, 8)->default(0);
            $table->decimal('final_amount', 18, 8)->default(0);
            $table->decimal('btc_amount', 18, 8)->nullable();
            $table->string('btc_wallet', 191)->nullable();
            $table->string('transaction', 25)->nullable();
            $table->integer('try')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1=> Complete, 2=> Pending, 3 => Cancel');
            $table->text('detail')->nullable();
            $table->text('feedback')->nullable();
            $table->string('payment_id', 61)->nullable();
            $table->string('type')->nullable()->default('appointment');
            $table->integer('transaction_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('funds');
    }
};
