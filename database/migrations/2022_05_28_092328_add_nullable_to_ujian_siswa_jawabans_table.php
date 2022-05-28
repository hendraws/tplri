<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToUjianSiswaJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujian_siswa_jawaban_kecerdasans', function (Blueprint $table) {
            $table->unsignedInteger('jawaban_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ujian_siswa_jawabans', function (Blueprint $table) {
            //
        });
    }
}
