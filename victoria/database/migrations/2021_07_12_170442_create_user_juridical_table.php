<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserJuridicalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_juridicals', function (Blueprint $table) {
            $table->integer('user_id')->comment('ID пользователя');
            $table->string('title_org')->comment('Название организации');
            $table->string('inn_org')->comment('ИНН организации');
            $table->string('phone_org')->comment('Телефон сотрудника');
            $table->string('surname_worker')->comment('Фамилия сотрудника');
            $table->string('name_worker')->comment('Имя сотрудника');
            $table->string('patronymic_worker')->nullable()->comment('Отчетсво сотрудника');
            $table->string('address_juridical_org')->nullable()->comment('Юридический адрес организации');
            $table->string('address_physical_org')->nullable()->comment('Физический адрес организации');
            $table->string('bank_org')->nullable()->comment('Банк организации');
            $table->string('bik_bank')->nullable()->comment('Бик банка');
            $table->string('payment_account_org')->nullable()->comment('Расчетный счёт');
            $table->string('correspondent_account_org')->nullable()->comment('Корреспондентский счёт');
            $table->string('surname_director')->nullable()->comment('Имя директора');
            $table->string('name_director')->nullable()->comment('Фамилия директора');
            $table->string('patronymic_director')->nullable()->comment('Отчетсво директора');
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
        Schema::dropIfExists('user_juridicals');
    }
}
