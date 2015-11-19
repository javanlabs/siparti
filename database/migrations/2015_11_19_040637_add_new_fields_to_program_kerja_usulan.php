<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToProgramKerjaUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_kerja_usulan', function (Blueprint $table) {
            $table->text('manfaat')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('target')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_kerja_usulan', function (Blueprint $table) {
            $table->dropColumn(['manfaat', 'lokasi', 'target']);
        });
    }
}
