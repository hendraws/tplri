<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_nilais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ujian_siswa_id');
            $table->string('kecerdasan')->default(0);
            $table->string('kecermatan')->default(0);
            $table->string('kepribadian')->default(0);
            $table->string('nilai_akhir')->default(0);
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
        Schema::dropIfExists('ujian_nilais');
    }
}
