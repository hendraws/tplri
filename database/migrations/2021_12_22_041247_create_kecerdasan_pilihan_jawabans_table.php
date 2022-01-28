<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecerdasanPilihanJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecerdasan_pilihan_jawabans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kecerdasan_id');
            $table->string('pilihan');
            $table->text('jawaban');
            $table->string('benar',1)->default('N');
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
        Schema::dropIfExists('kecerdasan_pilihan_jawabans');
    }
}
