<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkdinUjianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikdin_ujian_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->bigInteger('user_id');
            $table->bigInteger('ujian_id');
            $table->string('skd', 1)->default(0);
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
        Schema::dropIfExists('ikdin_ujian_siswas');
    }
}
