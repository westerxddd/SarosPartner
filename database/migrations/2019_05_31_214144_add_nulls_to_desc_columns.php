<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullsToDescColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->longText('desc')->nullable()->change();
            $table->string('image')->nullable()->change();
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->longText('desc')->nullable()->change();
            $table->string('image')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
