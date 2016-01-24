<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', function()
{
	return View::make('web.index');
});

Route::get('sejarah','WebController@sejarah');
Route::get('visi_misi','WebController@visi_misi');
Route::get('data_guru','WebController@data_guru');
Route::get('data_siswa','WebController@data_siswa');
Route::post('get_kelas','WebController@get_kelas');
Route::post('tampil_rombel','WebController@tampil_rombel');
Route::get('kontak','WebController@kontak');
Route::get('gallery','WebController@gallery');
Route::get('detail_gallery/{id}','WebController@detail_gallery');
Route::get('berita','WebController@berita');
Route::get('detail_berita/{id}','WebController@detail_berita');
Route::get('login','WebController@login');
Route::post('authenticate','WebController@authenticate');
Route::get('logout','WebController@logout');

Route::group(array('before'=>'auth'),function(){
	//akses untuk admin
	Route::group(array('prefix'=>'admin','before'=>'admin'),function(){
		Route::get('index','AdminController@index');
		Route::resource('kategori','KategoriController');
		Route::resource('berita','BeritaController');
		Route::resource('ekstrakurikuler','EkstraController');
		Route::resource('banner','BannerController');
		Route::resource('gallery','AlbumController');
		Route::resource('kkm','KkmController');
		Route::get('gallery/{id}/tambahfoto','AlbumController@tambahfoto');
		Route::post('simpanfoto','AlbumController@simpanfoto');
		Route::post('hapusdetailfoto','AlbumController@hapusfoto');

		Route::resource('siswa','SiswaController');
		Route::get('import_siswa','SiswaController@form_import');
		Route::post('proses_import','SiswaController@importExcel');

		Route::resource('guru','GuruController');
		Route::get('import_guru',array('as'=>'import_guru','uses'=>'GuruController@form_import'));
		Route::post('import_guru',array('as'=>'import_guru','uses'=>'GuruController@proses_import'));

		Route::resource('mapel','PelajaranController');
		Route::resource('kelas','KelasController');
		Route::resource('jam','JamController');


		Route::resource('rombel','RombelController');
		Route::get('rombel/{id}/tambah_siswa','RombelController@tambah_siswa');
		Route::post('hapus_siswa_rombel','RombelController@hapus_siswa');
		Route::post('import_rombel','RombelController@import');

		Route::get('cari_siswa','RombelController@cari_siswa');
		Route::post('get_siswa','RombelController@get_siswa');
		Route::post('simpan_siswa','RombelController@simpan_siswa');

		Route::resource('mengajar','MengajarController');
		Route::get('cari_nip','MengajarController@cari_nip');
		Route::get('cari_mengajar','MengajarController@cari_mengajar');
		Route::post('simpan_mengajar','MengajarController@simpan_mengajar');
		Route::post('hapus_mengajar','MengajarController@hapus_mengajar');
		Route::post('update_nilai','MengajarController@update_nilai');
		Route::get('import_mengajar',array('as'=>'import_mengajar','uses'=>'MengajarController@form_import'));
		Route::post('import_mengajar',array('as'=>'import_mengajar','uses'=>'MengajarController@import'));

		Route::get('jadwal','JadwalController@index');
		Route::get('setting_jadwal/{id}','JadwalController@setting_jadwal');
		Route::get('cari_jam_jadwal','JadwalController@cari_jam_jadwal');
		Route::get('get_jam','JadwalController@get_jam');
		Route::get('jadwal_get_guru','JadwalController@jadwal_get_guru');
		Route::post('simpan_jadwal','JadwalController@simpan_jadwal');
		Route::post('hapus_jadwal','JadwalController@hapus_jadwal');
		Route::get('lihat_jadwal/{id}','JadwalController@lihat_jadwal');

		Route::get('setting',array('as'=>'setting','uses'=>'SettingController@index'));
		Route::post('setting',array('as'=>'setting','uses'=>'SettingController@simpan'));

		Route::resource('user','UserController');
		Route::post('aktivasi_user','UserController@aktivasi');
		Route::post('nonaktif_user','UserController@nonaktif');

		Route::get('group','GroupController@index');
		Route::post('aktifkangroup','GroupController@aktif');
		Route::post('nonaktifkangroup','GroupController@nonaktif');

		//kesiswaaan-pindah
		Route::get('pindah_kelas','MutasiController@pindah_kelas');
		Route::get('pindah_cari_kelas','MutasiController@pindah_cari_kelas');
		Route::get('get_mutasi_siswa_rombel','MutasiController@get_mutasi_siswa_rombel');
		Route::post('proses_mutasi','MutasiController@proses_mutasi');

		//kesiswaaan-kenaikan
		Route::get('kenaikan_kelas','KenaikanController@index');
		Route::get('get_kenaikan_siswa','KenaikanController@get_kenaikan_siswa');
		Route::get('cari_kenaikan_kelas','KenaikanController@cari_kenaikan_kelas');
		Route::post('simpan_kenaikan_kelas','KenaikanController@simpan_kenaikan_kelas');

		//tinggal kelas
		Route::get('tinggal_kelas','KenaikanController@tinggal_kelas');
		Route::get('cari_tinggal_kelas','KenaikanController@cari_tinggal_kelas');
		Route::post('simpan_tinggal_kelas','KenaikanController@simpan_tinggal_kelas');


		//laporan
		Route::get('lap_rombel','LapController@rombel');
		Route::get('lap_get_tahun','LapController@get_tahun');
		Route::get('cetak_rombel','LapController@cetak_rombel');

		Route::get('lap_mengajar','LapController@mengajar');
		Route::get('cetak_mengajar','LapController@cetak_mengajar');

		Route::get('lap_jadwal','LapController@jadwal');
		Route::get('cetak_jadwal','LapController@cetak_jadwal');

		Route::get('lap_n_harian','LapController@n_harian');
		Route::get('cetak_n_harian','LapController@cetak_harian');

		Route::get('lap_n_ujian','LapController@n_ujian');
		Route::get('cetak_n_ujian','LapController@cetak_ujian');
	});
	//end akses untuk admin

	//hak akses untuk guru
	Route::group(array('prefix'=>'guru','before'=>'guru'),function(){
		Route::get('index','AdminGuru@index');
		Route::get('rombel','AdminGuru@rombel');
		Route::get('get_rombel','AdminGuru@get_rombel');
		Route::get('mengajar','AdminGuru@mengajar');
		Route::get('get_guru','AdminGuru@get_guru');
		Route::get('get_mengajar','AdminGuru@get_mengajar');

		Route::resource('materi','MateriController');

		Route::get('profile','AdminGuru@profile');
		Route::post('update_profile','AdminGuru@update_profile');

		Route::get('password','AdminGuru@password');
		Route::post('update_password','AdminGuru@update_password');

		Route::get('jadwal','AdminGuru@jadwal');
		Route::get('tampil_jadwal','JadwalController@view');

		Route::get('n_harian','AdminGuru@n_harian');
		Route::get('{id}/input_nilai_harian','AdminGuru@input_nilai_harian');
		Route::get('{id}/lihat_nilai_harian','AdminGuru@lihat_nilai_harian');
		Route::get('{id}/history_nilai_harian','AdminGuru@history_nilai_harian');
		Route::get('{rombel}/{semester}/{mapel}/{urut}/edit_nilai_harian','AdminGuru@edit_nilai_harian');
		Route::post('simpan_harian','AdminGuru@simpan_harian');
		Route::post('update_nilai_harian','AdminGuru@update_harian');
		Route::get('get_nomer','AdminGuru@get_nomer');

		Route::get('n_ujian','AdminGuru@n_ujian');
		Route::get('{id}/input_nilai_uts','AdminGuru@input_nilai_uts');
		Route::post('simpan_uts','AdminGuru@simpan_uts');
		Route::get('{id}/input_nilai_uas','AdminGuru@input_nilai_uas');
		Route::post('simpan_uas','AdminGuru@simpan_uas');

		Route::get('lap_harian','AdminGuru@lap_harian');
		Route::get('cetak_n_harian','AdminGuru@cetak_n_harian');
		Route::get('cari_mapel','AdminGuru@cari_mapel');

		Route::get('lap_ujian','AdminGuru@lap_ujian');
		Route::get('cetak_n_ujian','AdminGuru@cetak_n_ujian');
	});
	//end akses untuk guru


	//hak akses untuk siswa
	Route::group(array('prefix'=>'siswa','before'=>'siswa'),function(){
		Route::get('index','AdminSiswa@index');
		Route::get('rombel','AdminSiswa@rombel');
		Route::get('get_rombel','AdminSiswa@get_rombel');
		Route::get('mengajar','AdminSiswa@mengajar');
		Route::get('get_guru','AdminSiswa@get_guru');
		Route::get('get_mengajar','AdminSiswa@get_mengajar');

		Route::get('profile','AdminSiswa@profile');
		Route::post('update_profile','AdminSiswa@update_profile');

		Route::get('password','AdminSiswa@password');
		Route::post('update_password','AdminSiswa@update_password');

		Route::get('jadwal','AdminSiswa@jadwal');
		Route::get('tampil_jadwal','JadwalController@view');

		//laporan
		Route::get('nilai_harian','AdminSiswa@n_harian');
		Route::get('cetak_n_harian','AdminSiswa@cetak_n_harian');

		Route::get('nilai_ujian','AdminSiswa@n_ujian');
		Route::get('cetak_n_ujian','AdminSiswa@cetak_n_ujian');

		Route::get('nilai_raport','AdminSiswa@n_raport');
		Route::get('cetak_raport','AdminSiswa@cetak_raport');
	});
});

