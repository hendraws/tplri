<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecermatanSamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('kecermatan_samas')) {
            Schema::create('kecermatan_samas', function (Blueprint $table) {
                $table->id();
                $table->string('jawaban_a')->nullable();
                $table->string('jawaban_b')->nullable();
                $table->string('jawaban_c')->nullable();
                $table->string('jawaban_d')->nullable();
                $table->string('jawaban_e')->nullable();
                $table->string('kategori')->nullable();
                $table->bigInteger('created_by')->nullable();
                $table->bigInteger('updated_by')->nullable();
                $table->bigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('kecermatan_samas');
    }
}
