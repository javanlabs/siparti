<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramKerjaUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_kerja_usulan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('creator_id');
            $table->text('instansi_stakeholder');

            $table->softDeletes();
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
        Schema::table('program_kerja_usulan', function (Blueprint $table) {
            $table->drop();
        });
    }
}
