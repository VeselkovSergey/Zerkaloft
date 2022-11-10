<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFastMenuSpecialOrderInSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['fastMenu'])->update([
                'value' => json_encode([
                    'fastOrderLink' => 'true',
                    'calculatorLink' => 'true',
                    'onlineOrderLink' => 'true',
                    'specialOrderLink' => 'true',
                    'buttonUploadDesign' => 'true',
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
