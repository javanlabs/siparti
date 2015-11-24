<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameProgramKerjaUsulanToUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_kerja_usulan', function (Blueprint $table) {
            $table->rename('usulan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan', function (Blueprint $table) {
            $table->rename('program_kerja_usulan');
        });

    }
}
