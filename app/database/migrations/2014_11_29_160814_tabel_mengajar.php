<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelMengajar extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mengajar', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_guru');
			$table->string('kd_mapel',5);
			$table->string('thn_ajaran',9);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mengajar');
	}

}
