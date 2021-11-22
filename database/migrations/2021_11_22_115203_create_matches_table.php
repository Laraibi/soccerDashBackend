<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->integer("homeTeam_id");
            $table->integer("awayTeam_id");
            $table->integer("competetion_id");
            $table->date("day");
            $table->time("time")->nullable();
            $table->unsignedInteger("scoreHome")->nullable();
            $table->unsignedInteger("scoreAway")->nullable();
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
        Schema::dropIfExists('matches');
    }
}
