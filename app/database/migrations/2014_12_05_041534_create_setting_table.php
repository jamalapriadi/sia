<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('setting', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nm_sekolah',45);
			$table->string('alamat_sekolah',45);
			$table->string('kabupaten',30);
			$table->string('kecamatan',30);
			$table->string('status_sekolah',10);
			$table->string('status_mutu',10);
			$table->string('npsn',20);
			$table->string('nss',20);
			$table->string('akreditasi',1);
			$table->string('telp_sekolah',15);
			$table->string('fax_sekolah',15);
			$table->string('logo_sekolah',100);
			$table->string('nip_kepsek',18);
			$table->string('dari_tahun',4);
			$table->string('sampai_tahun',4);
			$table->enum('semester',array('1','2'));
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
		Schema::drop('setting');
	}

}
