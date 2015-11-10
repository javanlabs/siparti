<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUjiPublikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uji_publik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('creator_id');
            $table->text('materi');

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
        Schema::table('uji_publik', function (Blueprint $table) {
            $table->drop();
        });
    }
}
