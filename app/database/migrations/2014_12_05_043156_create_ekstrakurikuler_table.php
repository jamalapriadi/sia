<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEkstrakurikulerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ekstrakurikuler', function(Blueprint $table)
		{
			$table->increments('id_ekstra');
			$table->string('nm_ekstra',45);
			$table->string('logo_ekstra',45);
			$table->string('nip_pengampu',18);
			$table->text('keterangan');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ekstrakurikuler');
	}

}
