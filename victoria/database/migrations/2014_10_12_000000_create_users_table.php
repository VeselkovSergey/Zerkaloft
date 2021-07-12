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
            $table->integer('type_user')->comment('Тип пользователья физик/юрик');
            $table->string('email')->unique()->comment('почта/логин');
            $table->timestamp('email_verified_at')->nullable()->comment('Подтверждена ли почта?');
            $table->string('password')->comment('Пароль');
            $table->rememberToken()->comment('Токен восстановления');
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
