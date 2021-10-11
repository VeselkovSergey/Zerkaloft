<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhysicalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_physicals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ID пользователя');
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic');
            $table->string('phone');
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
        Schema::dropIfExists('user_physicals');
    }
}
