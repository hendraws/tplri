<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSiswaJababanKecerdasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_siswa_jababan_kecerdasans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ujian_siswa_id');
            $table->bigInteger('soal_id');
            $table->bigInteger('kategori')->comment('1 kecerdasan, 2 kecermatan, 3 kepribadian sesi 1, 4 kepirbadian sesi2');
            $table->bigInteger('jawaban_id');
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
        Schema::dropIfExists('ujian_siswa_jababan_kecerdasans');
    }
}
