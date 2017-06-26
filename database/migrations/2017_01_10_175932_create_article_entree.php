<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleEntree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_entrees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entree_id');
            $table->unsignedInteger('article_id');
            $table->float('unite');
            $table->double('prix');

            $table->foreign('entree_id')->references('id')->on('entrees');
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
        Schema::drop('article_entrees');
    }
}
