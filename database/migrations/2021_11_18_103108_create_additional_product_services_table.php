<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalProductServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_product_services', function (Blueprint $table) {
            $table->id();
            $table->integer('additional_service_id')->comment('ИД дополнительной услуги');
            $table->integer('product_id')->comment('Ид продукта');
            $table->string('price')->comment('цена');
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
        Schema::dropIfExists('additional_product_services');
    }
}
