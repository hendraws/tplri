<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkademikUjianNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akademik_ujian_nilais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('akademik_ujian_siswa_id');
            $table->string('mtk')->nullable();
            $table->string('wk')->nullable();
            $table->string('pu')->nullable();
            $table->string('bind')->nullable();
            $table->string('bing')->nullable();
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
        Schema::dropIfExists('akademik_ujian_nilais');
    }
}
