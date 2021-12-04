<?php

use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->json('value');
            $table->timestamps();
        });

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['mainPhone'],
            'value' => json_encode(['phone' => '+7(999)999-99-99'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['additionalPhones'],
            'value' => json_encode(['phone' => '+7(999)999-99-99;+7(999)999-99-99'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['calculatorPageText'],
            'value' => json_encode(['text' => 'Текст для страницы калькулятора'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['onlineOrderPageText'],
            'value' => json_encode(['text' => 'Текст для страницы онлайн заказа'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['onlineOrderPageText'],
            'value' => json_encode(['text' => 'Текст для страницы онлайн заказа'])
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
