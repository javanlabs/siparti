<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentModeToFase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fase', function (Blueprint $table) {
            $table->enum('comment_mode', ['show', 'hide', 'lock'])->before('comment')->default('show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fase', function (Blueprint $table) {
            $table->dropColumn('comment_mode');
        });
    }
}
