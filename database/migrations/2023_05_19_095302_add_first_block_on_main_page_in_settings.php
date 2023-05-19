<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFirstBlockOnMainPageInSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Settings::create([
            'type' => \App\Models\Settings::TypeByWords['firstBlockOnMainPage'],
            'value' => json_encode([
                'text' => 'Текст первого блока на главной страницы',
                'imageFileId' => [],
                'imageSquareFileId' => [],
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
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
