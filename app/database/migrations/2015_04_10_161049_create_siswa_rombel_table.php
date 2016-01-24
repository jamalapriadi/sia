<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaRombelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('siswa_rombel', function(Blueprint $table)
		{
			$table->string('kd_rombel',19);
			$table->string('nis',4);

			$table->primary(array('kd_rombel','nis'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('siswa_rombel');
	}

}
