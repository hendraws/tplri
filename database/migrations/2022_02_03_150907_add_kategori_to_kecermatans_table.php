<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriToKecermatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('kecermatans')) {
            Schema::table('kecermatans', function (Blueprint $table) {
                $table->string('kategori')->nullable()->after('soal_e');
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
        Schema::table('kecermatans', function (Blueprint $table) {
            //
        });
    }
}
