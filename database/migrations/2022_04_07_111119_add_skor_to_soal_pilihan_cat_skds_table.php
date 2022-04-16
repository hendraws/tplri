<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkorToSoalPilihanCatSkdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soal_pilihan_cat_skds', function (Blueprint $table) {
            $table->integer('skor')->after('benar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soal_pilihan_cat_skds', function (Blueprint $table) {
            //
        });
    }
}
