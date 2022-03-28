<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenToUjianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('ujian_siswa', 'token')) //check the column
        {
            Schema::table('ujian_siswas', function (Blueprint $table) {
                $table->string('token')->nullable()->after('status_ujian');
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
        Schema::table('ujian_siswas', function (Blueprint $table) {
            //
        });
    }
}
