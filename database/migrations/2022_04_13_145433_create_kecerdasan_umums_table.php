<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecerdasanUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecerdasan_umums', function (Blueprint $table) {
            $table->id();
            $table->longText('pertanyaan')->nullable();
            $table->bigInteger('kategori')->nullable();
            $table->bigInteger('jawaban_id')->nullable();
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
        Schema::dropIfExists('kecerdasan_umums');
    }
}
