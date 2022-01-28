<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalPilihanGandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('soal_pilihan_gandas')) {

            Schema::create('soal_pilihan_gandas', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('soal_id');
                $table->string('pilihan');
                $table->text('jawaban');
                $table->integer('bobot_nilai')->default(1);
                $table->string('benar', 1)->default('N');
                $table->string('pilihan_gambar', 1)->default('N');
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('soal_pilihan_gandas');
    }
}
