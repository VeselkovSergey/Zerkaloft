<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(-1)->comment('ID юзера если авторизован');
            $table->longText('products')->comment('Заказанные продукты');
            $table->string('client_name')->comment('Имя клиента');
            $table->string('client_surname')->comment('Фамилия клиента');
            $table->string('client_phone')->comment('Номер телефона');
            $table->string('client_email')->comment('Email клиента');
            $table->longText('client_comment')->nullable()->comment('Коментарий к заказу');
            $table->integer('type_payment')->comment('Тип оплаты');
            $table->integer('type_delivery')->comment('Тип получения');
            $table->integer('payment_status')->comment('Статус оплаты')->default(1);
            $table->integer('order_status')->comment('Статус заказа')->default(1);
            $table->longText('delivery_address')->comment('Адрес получения');
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
        Schema::dropIfExists('orders');
    }
}
