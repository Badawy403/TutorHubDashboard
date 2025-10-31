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
        Schema::create('users', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->integer('id', true);
            $table->string('name', 191);
            $table->string('email', 191);
            $table->boolean('is_active')->nullable()->default(true);
            $table->integer('country_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('profile_image_path')->nullable();
            $table->rememberToken();
            $table->boolean('is_two_factor_enabled')->nullable()->default(false);
            $table->text('two_factor_verification_code')->nullable();
            $table->timestamp('two_factor_verification_expiry')->nullable();
            $table->timestamp('password_last_changed')->nullable();
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
        Schema::dropIfExists('users');
    }
};
