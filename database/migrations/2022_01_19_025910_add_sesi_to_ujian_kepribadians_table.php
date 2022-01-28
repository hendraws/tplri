<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSesiToUjianKepribadiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('ujian_kepribadians')) {
            Schema::table('ujian_kepribadians', function (Blueprint $table) {
                $table->string('sesi',1)->after('kepribadian_id');
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
        Schema::table('ujian_kepribadians', function (Blueprint $table) {
            //
        });
    }
}
