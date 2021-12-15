<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название категории');
            $table->string('img')->comment('Файлы картинки');
            $table->string('semantic_url')->comment('Семантический URL')->nullable();
            $table->longText('additional_links')->comment('Дополнительные ссылки');
            $table->longText('search_words')->comment('Слова для поиска');
            $table->integer('sequence')->comment('Очередность');
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
        Schema::dropIfExists('categories');
    }
}
