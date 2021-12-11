<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePronosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pronos', function (Blueprint $table) {
            $table->id();
            $table->integer("match_id");
            $table->integer('user_id');
            $table->enum("prono",['x','1','2']);
            $table->boolean('exact')->nullable();
            $table->integer('mise');
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
        Schema::dropIfExists('pronos');
    }
}
