<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldToIkdinUjianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ikdin_ujian_siswa_jawabans', function (Blueprint $table) {
            $table->bigInteger('jawaban_id')->nullable()->change();
            $table->string('benar', 1)->nullable()->default(0)->change();
            $table->string('skor', 1)->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ikdin_ujian_siswa_jawabans', function (Blueprint $table) {
            //
        });
    }
}
