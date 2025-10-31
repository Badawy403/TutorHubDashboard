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
        Schema::create('teacher_payments_history', function (Blueprint $table) {
            $table->collation = 'latin1_swedish_ci';
            $table->charset = 'latin1';

            $table->integer('id', true);
            $table->integer('teacher_id')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->date('billing_date')->nullable();
            $table->string('payment_mode')->nullable()->default('recurring')->comment('recurring,manual');
            $table->integer('payment_method_id')->nullable();
            $table->longText('payment_credentials')->charset('utf8mb4')->collation('utf8mb4_bin')->nullable();
            $table->double('amount')->nullable()->default(0);
            $table->timestamp('payment_date')->nullable();
            $table->integer('atempts')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('teacher_payments_history');
    }
};
