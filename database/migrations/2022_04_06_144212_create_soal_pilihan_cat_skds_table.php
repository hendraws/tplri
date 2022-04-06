<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalPilihanCatSkdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_pilihan_cat_skds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('soal_id');
            $table->string('pilihan');
            $table->text('jawaban');
            $table->string('benar',1)->default('N');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_pilihan_cat_skds');
    }
}
