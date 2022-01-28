<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecermatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecermatans', function (Blueprint $table) {
            $table->id();
            $table->string('soal_a');
            $table->string('soal_b');
            $table->string('soal_c');
            $table->string('soal_d');
            $table->string('soal_e');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('edited_by')->nullable();
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
        Schema::dropIfExists('kecermatans');
    }
}
