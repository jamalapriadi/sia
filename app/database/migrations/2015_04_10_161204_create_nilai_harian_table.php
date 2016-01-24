<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiHarianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nilai_harian', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('kd_rombel',17);
			$table->string('kd_mapel',5);
			$table->enum('semester',array('1','2'));
			$table->integer('no_urut');
			$table->string('nis',4);
			$table->float('nilai');
			$table->timestamps();

			$table->foreign('kd_rombel')->references('kd_rombel')
				->on('rombel')
				->onDelete('cascade');

			$table->foreign('kd_mapel')->references('kd_mapel')
				->on('mapel')
				->onDelete('cascade');

			$table->foreign('nis')->references('nis')
				->on('siswa')
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
		Schema::drop('nilai_harian');
	}

}
