<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImportIdColumnToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedInteger('import_id')->nullable();
            $table->foreign('import_id')->references('id')->on('imports');
        });

        Schema::table('client_articles', function (Blueprint $table) {
            $table->unsignedInteger('import_id')->nullable();
            $table->foreign('import_id')->references('id')->on('imports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign('clients_import_id_foreign');
            $table->dropColumn('import_id');
        });

        Schema::table('client_articles', function (Blueprint $table) {
            $table->dropForeign('client_articles_import_id_foreign');
            $table->dropColumn('import_id');
        });
    }
}
