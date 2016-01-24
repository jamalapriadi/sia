<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeritaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('berita', function(Blueprint $table)
		{
			$table->increments('id_berita');
			$table->integer('id_kategori')->unsigned();
			$table->string('judul',45);
			$table->text('isi');
			$table->string('gambar',45);
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
		Schema::drop('berita');
	}

}
