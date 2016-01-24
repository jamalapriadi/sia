<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jadwal', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('kd_rombel',17);
			$table->string('hari',8);
			$table->smallInteger('jam_ke');
			$table->integer('id_guru');
			$table->string('kd_mapel',5);

			$table->foreign('id_guru')->references('id')
				->on('guru')
				->onDelete('cascade');

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
		Schema::drop('jadwal');
	}

}
