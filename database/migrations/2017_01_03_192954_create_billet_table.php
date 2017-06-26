<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBilletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_psg');
            $table->string('prenom_psg');
            $table->string('civilite_psg');
            $table->string('code_iata');
            $table->string('nom_comp');
            $table->string('code_comp');
            $table->string('numero_billet');
            $table->string('ref_dossier');
            $table->integer('id_comp');
            $table->integer('id_cli');
            $table->integer('client_id');
            $table->double('prix_htt');
            $table->double('prix_ttc');
            $table->double('commission');
            $table->double('frais_service');
            $table->double('net_a_payer');
            $table->double('montant_recu');
            $table->timestamp('date_billet');
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
        Schema::drop('billets');
    }
}
