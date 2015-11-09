<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaseTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fase', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', \App\Enum\FaseType::keys());
			$table->unsignedInteger('satket_id');
			$table->text('description');
			$table->text('scope');
			$table->text('target');
			$table->text('progress');
			$table->text('kendala');
			$table->text('instansi_terkait');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('pic', 255);
			$table->unsignedBigInteger('pagu');

			$table->timestamps();
			$table->softDeletes();

			$table->index('type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fase');
	}

}
