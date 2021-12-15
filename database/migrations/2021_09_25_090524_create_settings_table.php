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
            'value' => json_encode(['additionalPhones' => '+7(999)999-99-99;+7(999)999-99-99'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['viberPhone'],
            'value' => json_encode(['viberPhone' => '79999999999'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['whatsappPhone'],
            'value' => json_encode(['whatsappPhone' => '79999999999'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['telegramPhone'],
            'value' => json_encode(['telegramPhone' => '79999999999'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['mail'],
            'value' => json_encode(['mail' => 'mail@mail.mail'])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['calculatorPageText'],
            'value' => json_encode([
                'text' => 'Текст для страницы калькулятора',
                'imageFileId' => 0,
            ])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['onlineOrderPageText'],
            'value' => json_encode([
                'text' => 'Текст для страницы онлайн заказа',
                'imageFileId' => 0,
            ])
        ]);

        \App\Models\Settings::create([
            'type' => Settings::TypeByWords['fastOrderPageText'],
            'value' => json_encode([
                'text' => 'Текст для страницы онлайн заказа',
                'imageFileId' => 0,
            ])
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
