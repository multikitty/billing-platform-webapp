<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamIdToPracticeSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('practice_settings', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('practice_settings', 'team_id')) {
                $table->bigInteger('team_id')->unsigned();
                $table->foreign('team_id')->on('teams')->references('id')->onDelete('cascade')->onUpdate('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practice_settings', function (Blueprint $table) {
            //
            if (Schema::hasColumn('practice_settings', 'team_id')) {
                $table->dropColumn('team_id');
            }
        });
    }
}
