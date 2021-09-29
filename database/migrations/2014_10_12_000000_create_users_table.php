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
            $table->integer('type_user')->default(1)->comment('Тип пользователья физик/юрик');
            $table->string('email')->unique()->comment('почта/логин');
            $table->timestamp('email_verified_at')->nullable()->comment('Подтверждена ли почта?');
            $table->string('password')->comment('Пароль');
            $table->integer('role')->default(1)->comment('Роль');   // 1 - пользователь 10 - манагер 99 - админ
            $table->rememberToken()->comment('Токен восстановления');
            $table->timestamps();
        });

        $admin = \App\Models\User::create([
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin@admin.com'),
            'role' => 99,
        ]);

        $adminPhysicalUser = \App\Models\UserPhysicals::create([
            'user_id' => $admin->id,
            'surname' => 'Администратор',
            'name' => 'Администратор',
            'patronymic' => 'Администратор',
            'phone' => 'Администратор',
        ]);
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
