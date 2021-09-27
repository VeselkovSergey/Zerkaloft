<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceBooksValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_books_values', function (Blueprint $table) {
            $table->id();
            $table->string('value')->comment('Название справочника');
            $table->string('coefficient')->comment('Название справочника');
            $table->integer('reference_book_id')->comment('id справочника');
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
        Schema::dropIfExists('reference_books_values');
    }
}
