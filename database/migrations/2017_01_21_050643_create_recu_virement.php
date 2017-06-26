<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecuVirement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recu_virements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banque');
            $table->string('code')->nullable();
            $table->string('complement')->nullable();
            $table->boolean('effectif');
            $table->timestamp('date_effectif')->nullable();
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
        Schema::drop('recu_virements');
    }
}
