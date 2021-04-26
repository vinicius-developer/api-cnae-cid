<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCnaesCidsIdCnaeForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relacao_cnae_cids', function(Blueprint $table) {
            $table->foreign('id_cnae')->references('id_cnae')->on('cnaes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relacao_cnae_cids', function(Blueprint $table) {
            $table->dropForeign(['id_cnae']);
        });
    }
}
