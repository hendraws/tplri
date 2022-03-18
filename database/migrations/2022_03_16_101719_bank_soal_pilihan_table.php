<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankSoalPilihanTable extends Migration
{

    protected $tableName = 'soal_pilihan';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('DbBankSoal')->hasTable($this->tableName)){
            Schema::connection('DbBankSoal')->create($this->tableName, function (Blueprint $table){
                $table->id();
                $table->bigInteger('soal_id');
                $table->string('pilihan');
                $table->text('jawaban');
                $table->string('benar',1)->default('N');
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
        if(!Schema::connection('DbBankSoal')->hasTable($this->tableName)){
            Schema::connection('DbbankSoal')->dropIfExists($this->tableName);
        }
    }
}
