<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('ujian_id');
            $table->string('kecerdasan', 1)->default(0);
            $table->string('kepribadian', 1)->default(0);
            $table->string('kecermatan', 1)->default(0);
            $table->string('status_ujian', 1)->default(0)->comment('0 belum ujian, 1 sedang ujian, 2 selesai Ujian');
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
        Schema::dropIfExists('ujian_siswas');
    }
}
