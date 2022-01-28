<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianMataPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->integer('ujian_id');
            $table->integer('mata_pelajaran_id');
            $table->integer('jumlah_soal');
            $table->integer('passing_grade');
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
        Schema::dropIfExists('ujian_mata_pelajarans');
    }
}
