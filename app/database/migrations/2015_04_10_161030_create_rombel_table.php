<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRombelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rombel', function(Blueprint $table)
		{
			$table->string('kd_rombel',17)->primary();
			$table->string('kd_kelas',6);
			$table->string('thn_ajaran',9);
			$table->integer('id_wali');
			$table->timestamps();

			$table->foreign('id_wali')->references('id')
				->on('guru')
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
		Schema::drop('rombel');
	}

}
