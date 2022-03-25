<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriToUjiansTable extends Migration
{
    protected $myTable = 'ujians';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn($this->myTable, 'kategori')) //check the column
        {
            Schema::table($this->myTable, function (Blueprint $table) {
                $table->string('posisi')->nullable()->after('is_active');
                $table->string('kategori')->nullable()->after('is_active');
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
        Schema::table('ujians', function (Blueprint $table) {
            //
        });
    }
}
