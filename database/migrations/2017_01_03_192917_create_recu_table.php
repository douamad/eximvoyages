<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref');
            $table->string('piece')->nullable();
            $table->string('complement')->nullable();
            $table->timestamp('date_recu');
            $table->enum('moyen', ['cash','transfert','cheque','virement']);
            $table->double('montant');
            $table->unsignedInteger('entree_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('entree_id')->references('id')->on('entrees');
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
        Schema::drop('recus');
    }
}
