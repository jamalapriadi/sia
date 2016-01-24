<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiUnTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nilai_un', function(Blueprint $table)
		{
			$table->string('kd_rombel',17);
			$table->string('kd_mapel',5);
			$table->enum('semester',array('1','2'));
			$table->string('nis',4);
			$table->float('n_us');
			$table->float('n_un');
			$table->timestamps();

			$table->primary(array('kd_rombel','kd_mapel','nis'));

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
		Schema::drop('nilai_un');
	}

}
