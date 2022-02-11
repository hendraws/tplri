<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSiswaJawabanKepribadiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_siswa_jawaban_kepribadians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ujian_siswa_id');
            $table->bigInteger('soal_id');
            $table->bigInteger('jawaban')->comment('Jawaban Siswa');
            $table->integer('skor')->nullable();
            $table->integer('sesi')->nullable();
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
        Schema::dropIfExists('ujian_siswa_jawaban_kepribadians');
    }
}
