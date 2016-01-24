<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('SentrySeeder');
		$this->call('SettingSeeder');
		$this->call('KelasSeeder');
		$this->Call('MapelSeeder');
		$this->Call('JamSeeder');
	}

}
