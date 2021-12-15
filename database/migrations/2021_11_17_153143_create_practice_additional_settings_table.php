<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeAdditionalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_additional_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->boolean('checked')->default(false);

            $table->bigInteger('practice_setting_id')->unsigned();
            $table->foreign('practice_setting_id')->references('id')->on('practice_settings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practice_additional_settings');
    }
}
