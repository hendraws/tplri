<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('password');
            $table->string('motto')->nullable()->after('password');
            $table->text('alamat')->nullable()->after('password');
            $table->date('tanggal_lahir')->nullable()->after('password');
            $table->string('tempat_lahir')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('foto');
            $table->dropColumn('motto');
            $table->dropColumn('alamat');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('tempat_lahir');
        });
    }
}
