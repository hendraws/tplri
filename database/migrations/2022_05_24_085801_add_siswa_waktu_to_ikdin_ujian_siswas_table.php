<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiswaWaktuToIkdinUjianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ikdin_ujian_siswas', function (Blueprint $table) {
            $table->unsignedInteger('sisa_waktu')->after('skd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ikdin_ujian_siswas', function (Blueprint $table) {
            //
        });
    }
}
