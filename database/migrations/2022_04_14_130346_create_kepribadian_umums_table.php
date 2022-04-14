<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepribadianUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepribadian_umums', function (Blueprint $table) {
            $table->id();
            $table->longText('pertanyaan');
            $table->string('jenis');
            $table->integer('sesi')->comment('1 = sesi 1, 2 = sesi 2');
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
        Schema::dropIfExists('kepribadian_umums');
    }
}
