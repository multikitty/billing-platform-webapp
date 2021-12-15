<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('practice_logo')->nullable();
            $table->string('practice_name')->nullable();
            $table->string('practice_tax_num')->nullable();
            $table->string('practice_firstname')->nullable();
            $table->string('practice_lastname')->nullable();
            $table->string('practice_degree')->nullable();
            $table->string('practice_website')->nullable();
            $table->string('practice_tel')->nullable();
            $table->string('practice_email')->nullable();
            $table->string('practice_street')->nullable();
            $table->string('practice_postal_code')->nullable();
            $table->string('practice_province')->nullable();
            $table->string('practice_iban')->nullable();
            $table->string('practice_bic')->nullable();
            $table->string('practice_bank')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practice_settings');
    }
}
