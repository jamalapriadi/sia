<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jam_pelajaran', function(Blueprint $table)
		{
			$table->integer('jam_ke')->primary();
			$table->time('dari_jam');
			$table->time('sampai_jam');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jam_pelajaran');
	}

}
