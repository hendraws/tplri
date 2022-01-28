<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('soals')) {
            Schema::create('soals', function (Blueprint $table) {
                $table->id();
                $table->integer('mata_pelajaran_id');
                $table->text('pertanyaan');
                $table->string('jawaban_benar',1)->comment('Isian Pilihan A/B/C/D/E');
                $table->string('pertanyaan_gambar',1)->default('N');
                $table->string('created_by')->nullable();
                $table->text('updated_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('soals');
    }
}
