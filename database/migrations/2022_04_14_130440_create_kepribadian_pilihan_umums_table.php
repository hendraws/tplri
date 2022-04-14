<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepribadianPilihanUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepribadian_pilihan_umums', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sesi');
            $table->bigInteger('kepribadian_id');
            $table->string('pilihan');
            $table->text('jawaban');
            $table->string('bobot');
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
        Schema::dropIfExists('kepribadian_pilihan_umums');
    }
}
