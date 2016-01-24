<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelSiswa extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('siswa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nis',4);
			$table->string('nisn',10);
			$table->string('email',45);
			$table->string('nm_siswa',45);
			$table->enum('jk',array('L','P'));
			$table->string('tmp_lahir',45);
			$table->date('tgl_lahir');
			$table->string('agama',10);
			$table->string('nm_ayah',45);
			$table->string('nm_ibu',45);
			$table->string('alamat',45);
			$table->string('thn_sttb',4);
			$table->enum('status',array(0,1));
			$table->string('keterangan',45);
			$table->string('foto',45);

			$table->unique(array('nis','nisn','email'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('siswa');
	}

}
