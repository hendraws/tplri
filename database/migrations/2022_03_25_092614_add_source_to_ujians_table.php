<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSourceToUjiansTable extends Migration
{

    protected $myTable = 'ujians';
    protected $column = 'source';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn($this->myTable, $this->column)) //check the column
        {
            Schema::table($this->myTable, function (Blueprint $table) {
                $table->string($this->column)->nullable()->after('is_active');
                $table->unsignedBigInteger('deleted_by')->nullable()->after('updated_by');
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
