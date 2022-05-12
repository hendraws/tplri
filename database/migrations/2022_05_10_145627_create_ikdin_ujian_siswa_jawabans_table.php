<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkdinUjianSiswaJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikdin_ujian_siswa_jawabans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ikdin_ujian_siswa_id');
            $table->bigInteger('soal_id');
            $table->bigInteger('jawaban_id');
            $table->string('kategori')->nullable();
            $table->string('benar', 1);
            $table->string('skor', 1);
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
        Schema::dropIfExists('ikdin_ujian_siswa_jawabans');
    }
}
