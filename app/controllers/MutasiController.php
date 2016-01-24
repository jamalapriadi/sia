<?php
class MutasiController extends BaseController{
	public function pindah_kelas(){
		$setting=Setting::first();
		$kelas=Kelas::all();

		return View::make('mutasi.index')
			->with('setting',$setting)
			->with('kelas',$kelas);
	}

	public function pindah_cari_kelas(){
		if(Request::ajax()){
			$awal=Input::get('awal');
			$kelas=Kelas::find($awal);

			//cari data kelas yang tingkatnya sama dengan data kelas sekarang
			$lain=DB::table('kelas')
				->where('kelas','=',$kelas->kelas)
				->where('kd_kelas','<>',$awal)
				->get();

			foreach($lain as $row){
				echo "<option value='$row->kd_kelas'>$row->kd_kelas</option>";
			}
		}
	}

	public function get_mutasi_siswa_rombel(){
		if(Request::ajax()){
			$setting=Setting::first();
			$awal=Input::get('tahun').'-'.Input::get('awal');

			$siswa=DB::table('siswa_rombel')->where('kd_rombel','=',$awal)
				->join('siswa','siswa.nis','=','siswa_rombel.nis');

			$kode=Input::get('awal');
			$kelas=Kelas::find($kode);

			//cari data kelas yang tingkatnya sama dengan data kelas sekarang
			$lain=DB::table('kelas')
				->where('kelas','=',$kelas->kelas)
				->where('kd_kelas','<>',$kode)
				->get();

			
			return View::make('mutasi.siswa_rombel')
				->with('siswa',$siswa)
				->with('lain',$lain)
				->with('setting',$setting)
				->with('awal',$awal);
		}
	}

	public function proses_mutasi(){
		$pilih=Input::get('pilih');
		$dari=Input::get('daritahun');

		$kelas=Input::get('kelas');
		$tahun=Input::get('tahun');

		foreach($pilih as $row){
			//simpan ke siswa_rombel
			DB::table('siswa_rombel')
	            ->where('nis', $row)
	            ->update(array('kd_rombel' => Input::get('tahun').'-'.Input::get('kelas')));

			//simpan ke riwayat rombel
			$riwayat=array(
				'dari_rombel'=>$dari,
				'ke_rombel'=>Input::get('tahun').'-'.Input::get('kelas'),
				'nis'=>$row,
				'tanggal'=>date('Y-m-d'),
				'status'=>4,
			);
			DB::table('riwayat_rombel')->insert($riwayat);
		}

		$html=count($pilih)." Siswa berhasil dipindah<br>";
		Session::flash('pesan',$html);

		return View::make('mutasi.mutasi_sukses')
			->with('pilih',$pilih);

	}
}