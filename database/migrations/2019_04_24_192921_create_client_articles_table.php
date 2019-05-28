<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_articles', function (Blueprint $table) {
            $table->increments('id');
//            $table->string('name');
            $table->string('prefix');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
//            $table->string('index');
            $table->double('netto');
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
        Schema::dropIfExists('client_articles');
    }
}
