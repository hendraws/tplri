<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSiswaJawabanKecermatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_siswa_jawaban_kecermatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ujian_siswa_id');
            $table->bigInteger('soal_id');
            $table->string('soal_a');
            $table->string('soal_b');
            $table->string('soal_c');
            $table->string('soal_d');
            $table->string('jawaban');
            $table->integer('benar')->nullable();
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
        Schema::dropIfExists('ujian_siswa_jawaban_kecermatans');
    }
}
