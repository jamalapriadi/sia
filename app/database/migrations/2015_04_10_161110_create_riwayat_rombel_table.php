<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatRombelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('riwayat_rombel', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('dari_rombel',17);
			$table->string('ke_rombel',17);
			$table->string('nis',4);
			$table->date('tanggal');
			$table->enum('status',array('1','2','3','4'));
			//1= pertama masuk, 2 naik kelas, 3 tinggal kelas, 4 mutasi
			$table->timestamps();

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
		Schema::drop('riwayat_rombel');
	}

}
