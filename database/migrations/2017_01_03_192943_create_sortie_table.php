<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref');
            $table->string('piece');
            $table->string('complement');
            $table->timestamp('dates');
            $table->boolean('regler');
            $table->double('payer');
            $table->boolean('settaxe');
            $table->float('taxe');
            $table->unsignedInteger('fournisseur_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
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
        Schema::drop('sorties');
    }
}
