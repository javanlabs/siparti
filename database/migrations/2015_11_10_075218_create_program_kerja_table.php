<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('creator_id');
            $table->unsignedInteger('current_fase_id');
            $table->unsignedInteger('satker_id');

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
        Schema::table('program_kerja', function (Blueprint $table) {
            $table->drop();
        });
    }
}
