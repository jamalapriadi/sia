<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelasiDetailAlbum extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detail_album', function(Blueprint $table)
		{
			$table->foreign('id_album')->references('id_album')->on('album')
				->onDelete('restrict')
				->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detail_album', function(Blueprint $table)
		{
			$table->dropForeign('id_album');
		});
	}

}
