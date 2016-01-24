<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelGuru extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guru', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('nip',18);
			$table->string('nuptk',20);
			$table->string('email',45);
			$table->string('nm_guru',45);
			$table->string('tmp_lahir',45);
			$table->date('tgl_lahir');
			$table->enum('jk',array('L','P'));
			$table->string('pend_terakhir',5);
			$table->date('tahun');
			$table->string('mulai_kerja',4);
			$table->enum('status',array(0,1));
			$table->string('keterangan',45);
			$table->string('foto',45);

			$table->unique(array('nip','nuptk','email'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('guru');
	}

}
