<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAksesToUjianSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujian_siswas', function (Blueprint $table) {
            $table->string('status_akses')->nullable()->default(0)->after('token')->comment('0 untuk meminta akses, 1 di ijinkan, 2 di tolak');
        });
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
