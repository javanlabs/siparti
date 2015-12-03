<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToProgramKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_kerja', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->after('satker_id');
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
             $table->dropColumn('category_id');
        });
    }
}
