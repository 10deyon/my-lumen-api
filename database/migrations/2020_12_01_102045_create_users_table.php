<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("username")->nullable();
            $table->string("email")->unique();
            $table->string("phone_number")->unique();
            $table->string("password");
            $table->enum('type', ['user', 'vendor'])->default('user');
            $table->text("verification_token")->nullable();
            $table->string("verification_otp")->nullable();
            $table->string("verified_at")->nullable();
            $table->string("forgot_password_token")->nullable();
            $table->string("timestamp")->nullable();
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
        Schema::dropIfExists('users');
    }
}
