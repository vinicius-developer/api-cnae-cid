<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCnaesCidsIdCidForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relacao_cnae_cids', function(Blueprint $table) {
            $table->foreign('id_cid')->references('id_cid')->on('cids');
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
            $table->dropForeign(['id_cid']);
        });
    }
}
