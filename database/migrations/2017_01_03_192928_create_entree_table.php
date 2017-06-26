<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref');
            $table->string('piece');
            $table->string('complement');
            $table->timestamp('dates');
            $table->float('taxe');
            $table->boolean('settaxe');
            $table->boolean('regler');
            $table->double('payer');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::drop('entrees');
    }
}
