<?php
class TesController extends BaseController{
	public function index(){
		return View::make('tes.index');
	}

	public function nilai(){
		$jumlah_jenis=DB::table('jenis_nilai')->count();
		$jenis=Jenis::all();
		$nilai=DB::table('nilai_harian')
			->join('jenis_nilai','nilai_harian.kd_jenis','=','jenis_nilai.kd_jenis')
			->get();

		return View::make('tes.nilai')
			->with('jumlah_jenis',$jumlah_jenis)
			->with('jenis',$jenis)
			->with('nilai',$nilai);
	}
}
