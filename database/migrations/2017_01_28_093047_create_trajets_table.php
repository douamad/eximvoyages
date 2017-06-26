<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrajetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trajets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lieu_depart');
            $table->string('heure_depart')->nullable();
            $table->string('date_depart')->nullable();
            $table->string('vol_depart')->nullable();
            $table->string('enreg')->nullable();
            $table->string('statut')->nullable();
            $table->string('terminal')->nullable();
            $table->string('heure_arr')->nullable();
            $table->string('lieu_arr')->nullable();
            $table->unsignedInteger('billet_id');

            $table->foreign('billet_id')->references('id')->on('billets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trajets');
    }
}
