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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('dni', 8)->unique();
            $table->string('phone', 9);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->enum('status', ['verified', 'unverified'])->default('unverified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('file', 200)->nullable();
            $table->rememberToken();
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
