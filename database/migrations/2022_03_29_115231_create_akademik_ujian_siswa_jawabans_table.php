<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkademikUjianSiswaJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('akademik_ujian_siswa_jawabans')) {
            Schema::create('akademik_ujian_siswa_jawabans', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('akademik_ujian_siswa_id');
                $table->bigInteger('soal_id');
                $table->string('mapel');
                $table->bigInteger('jawaban_id');
                $table->string('benar', 1);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akademik_ujian_siswa_jawabans');
    }
}
