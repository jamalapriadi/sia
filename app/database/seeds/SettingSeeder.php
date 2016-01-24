<?php
class SettingSeeder extends Seeder{
	public function run(){
		DB::table('setting')->delete();

		$data=array(
			'nm_sekolah'=>'SMP N 1 Pagerbarang',
			'alamat_sekolah'=>'Jl. Randusari',
			'kabupaten'=>'Tegal',
			'kecamatan'=>'Pagerbarang',
			'status_sekolah'=>'Negeri',
			'status_mutu'=>'SPM',
			'npsn'=>'20325325',
			'nss'=>'201032805049',
			'akreditasi'=>'A',
			'telp_sekolah'=>'',
			'fax_sekolah'=>'',
			'logo_sekolah'=>'logo.png',
			'nip_kepsek'=>'',
			'dari_tahun'=>'2014',
			'sampai_tahun'=>'2015',
			'semester'=>'1'
		);

		DB::table('setting')->insert($data);
	}
}
