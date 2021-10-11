<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsCategoriesAndPropertiesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations_categories_and_properties_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->comment('ид категории');
            $table->integer('properties_categories_id')->comment('ид свойства категорий');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relations_categories_and_properties_categories');
    }
}
