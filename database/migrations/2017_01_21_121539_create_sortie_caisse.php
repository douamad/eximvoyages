<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortieCaisse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sortie_caisses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref');
            $table->string('piece')->nullable();
            $table->string('complement')->nullable();
            $table->timestamp('date_facture');
            $table->enum('moyen', ['cash','transfert','cheque','virement']);
            $table->double('montant');
            $table->unsignedInteger('sortie_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('sortie_id')->references('id')->on('sorties');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sortie_caisses');
    }
}
