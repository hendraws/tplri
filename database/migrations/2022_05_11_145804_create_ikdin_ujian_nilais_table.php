<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkdinUjianNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikdin_ujian_nilais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ikdin_ujian_siswa_id');
            $table->string('twk')->nullable();
            $table->string('tiu')->nullable();
            $table->string('tkp')->nullable();
            $table->string('nilai_akhir')->nullable();
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
        Schema::dropIfExists('ikdin_ujian_nilais');
    }
}
