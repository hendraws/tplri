<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if(!Schema::connection('DbBankSoal')->hasTable('soal')){
        //     Schema::connection('DbBankSoal')->create('soal', function (Blueprint $table){
        //         $table->id();
        //         $table->longText('pertanyaan');
        //         $table->bigInteger('jawaban_id');
        //         $table->string('mapel')->nullable();
        //         $table->string('jabatan')->nullable();
        //         $table->bigInteger('created_by')->nullable();
        //         $table->bigInteger('updated_by')->nullable();
        //         $table->bigInteger('deleted_by')->nullable();
        //         $table->timestamps();
        //         $table->softDeletes();
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(!Schema::connection('DbBankSoal')->hasTable('soal')){
            Schema::connection('DbBankSoal')->dropIfExists('soal');
        }
    }
}
