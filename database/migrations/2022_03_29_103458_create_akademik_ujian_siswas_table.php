<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkademikUjianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('akademik_ujian_siswas')) {
            Schema::create('akademik_ujian_siswas', function (Blueprint $table) {
                $table->id();
                $table->string('token');
                $table->bigInteger('user_id');
                $table->bigInteger('ujian_id');
                $table->string('mtk', 1)->default(0);
                $table->string('wk', 1)->default(0);
                $table->string('pu', 1)->default(0);
                $table->string('bahasa', 1)->default(0)->comment('0 belum ujian, 1 sedang ujian, 2 selesai Ujian');
                $table->string('status', 1)->default(0)->comment('0 belum ujian, 1 sedang ujian, 2 selesai Ujian');
                $table->timestamps();
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
        Schema::dropIfExists('akademik_ujian_siswas');
    }
}
