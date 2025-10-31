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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->integer('id', true);
            $table->integer('teacher_id')->nullable();
            $table->integer('academy_id')->nullable();
            $table->integer('broadcast_category_id')->nullable();
            $table->longText('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('slug')->nullable();
            $table->integer('is_active')->default(1);
            $table->boolean('is_featured')->nullable()->default(false);
            $table->longText('image')->nullable();
            $table->string('link_type')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_url')->nullable();
            $table->string('audio')->nullable();
            $table->string('video')->nullable();
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
        Schema::dropIfExists('broadcasts');
    }
};
