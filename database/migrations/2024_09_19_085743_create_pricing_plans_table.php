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
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->integer('id', true);
            $table->string('name');
            $table->mediumText('description');
            $table->string('type')->nullable();
            $table->string('tagline')->nullable();
            $table->string('image')->nullable();
            $table->string('color')->nullable();
            $table->string('stripe_plan')->nullable();
            $table->double('price')->nullable();
            $table->string('slug')->nullable();
            $table->integer('sort_order')->nullable();
            $table->integer('is_active')->default(1);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_paid')->default(true);
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
        Schema::dropIfExists('pricing_plans');
    }
};
