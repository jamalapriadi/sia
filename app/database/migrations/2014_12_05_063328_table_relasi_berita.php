<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelasiBerita extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('berita', function(Blueprint $table)
		{
			$table->foreign('id_kategori')->references('id_kategori')->on('kategori');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('berita', function(Blueprint $table)
		{
			$table->dropForeign('id_kategori');
		});
	}

}
