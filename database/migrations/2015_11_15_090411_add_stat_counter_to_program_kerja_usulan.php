<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatCounterToProgramKerjaUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_kerja_usulan', function (Blueprint $table) {
            $table->unsignedInteger('comment')->after('instansi_stakeholder');
            $table->unsignedInteger('vote_up')->after('comment');
            $table->unsignedInteger('vote_down')->after('vote_up');
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
            $table->dropColumn(['comment', 'vote_up', 'vote_down']);
        });
    }
}
