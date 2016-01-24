<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKkmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kkm', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('thn_ajaran',9);
			$table->string('kd_mapel',5);
			$table->float('nilai_kkm');
			$table->timestamps();

			$table->foreign('kd_mapel')->references('kd_mapel')
				->on('mapel')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kkm');
	}

}
