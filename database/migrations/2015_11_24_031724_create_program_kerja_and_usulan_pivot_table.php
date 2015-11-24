<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramKerjaAndUsulanPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_kerja_usulan', function (Blueprint $table) {
            $table->integer('program_kerja_id')->unsigned()->index();
            $table->foreign('program_kerja_id')->references('id')->on('program_kerja')->onDelete('cascade');
            $table->integer('usulan_id')->unsigned()->index();
            $table->foreign('usulan_id')->references('id')->on('usulan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('program_kerja_usulan');
    }
}
