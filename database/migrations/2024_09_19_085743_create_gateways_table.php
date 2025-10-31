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
        Schema::create('gateways', function (Blueprint $table) {
            $table->collation = 'utf8mb4_unicode_ci';
            $table->charset = 'utf8mb4';

            $table->unsignedInteger('id')->primary();
            $table->string('name', 191);
            $table->string('code', 191)->unique();
            $table->string('currency', 191);
            $table->string('symbol', 191);
            $table->text('parameters')->nullable();
            $table->text('extra_parameters')->nullable();
            $table->decimal('convention_rate', 18, 8)->default(1);
            $table->text('currencies')->nullable();
            $table->decimal('min_amount', 18, 8);
            $table->decimal('max_amount', 18, 8);
            $table->decimal('percentage_charge', 8, 4)->default(0);
            $table->decimal('fixed_charge', 18, 8)->default(0);
            $table->boolean('status')->default(true)->comment('0: inactive, 1: active');
            $table->text('note')->nullable();
            $table->string('image', 191)->nullable();
            $table->integer('sort_by')->nullable()->default(1);
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
        Schema::dropIfExists('gateways');
    }
};
