<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecuCheque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recu_cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banque');
            $table->string('code')->nullable();
            $table->string('complement')->nullable();
            $table->boolean('encaisser');
            $table->timestamp('date_encaissement')->nullable();
            $table->double('montant');
            $table->unsignedInteger('recu_id');
            $table->timestamps();

            $table->foreign('recu_id')->references('id')->on('recus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recu_cheques');
    }
}
