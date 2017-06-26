<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleSortie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_sorties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sortie_id');
            $table->unsignedInteger('article_id');
            $table->float('unite');
            $table->double('prix');

            $table->foreign('sortie_id')->references('id')->on('sorties');
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_sorties');
    }
}
