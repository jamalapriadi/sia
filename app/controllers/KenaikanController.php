<?php
class KenaikanController extends BaseController{
	public function index(){
		$setting=Setting::first();

		$kelas=DB::table('kelas')
			->where('kelas','<>','9')
			->get();

		return View::make('kenaikan.index')
			->with('setting',$setting)
			->with('kelas',$kelas);
	}

	public function cari_kenaikan_kelas(){
		if(Request::ajax()){
			$setting=Setting::first();
			$awal=Input::get('tahun').'-'.Input::get('awal');


			$siswa=DB::select("select a.*,c.* from siswa_rombel a,
			siswa c where kd_rombel='$awal'
			and kd_rombel in(select b.kd_rombel from nilai_ujian b
                 where b.kd_rombel=a.kd_rombel)
                 and c.nis=a.nis");

			$kelas=Kelas::find(Input::get('awal'));

			//cari data kelas yang tingkatnya sama dengan data kelas sekarang
			if($kelas->kelas=='7'){
				$lain=DB::table('kelas')
						->where('kelas','=','8')
						->get();
			}else if($kelas->kelas=='8'){
				$lain=DB::table('kelas')
						->where('kelas','=','9')
						->get();
			}else{
				$lain="";
			}


			if(count($siswa)>0){
				return View::make('kenaikan.get_siswa')
					->with('siswa',$siswa)
					->with('awal',$awal)
					->with('setting',$setting)
					->with('lain',$lain);
			}else{
				echo "<div class='alert alert-danger'>Tidak ada data</div>";
			}
		}
	}

	public function simpan_kenaikan_kelas(){
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
				'status'=>2,
			);
			DB::table('riwayat_rombel')->insert($riwayat);
		}

		$html=count($pilih)." Proses Kenaikan siswa berhasil<br>";
		Session::flash('pesan',$html);

		return View::make('mutasi.mutasi_sukses')
			->with('pilih',$pilih);
	}

	public function tinggal_kelas(){
		$setting=Setting::first();

		$kelas=DB::table('kelas')
			->where('kelas','<>','9')
			->get();

		return View::make('kenaikan.tinggal_kelas')
			->with('setting',$setting)
			->with('kelas',$kelas);
	}

	public function cari_tinggal_kelas(){
		if(Request::ajax()){
			$setting=Setting::first();
			$awal=Input::get('tahun').'-'.Input::get('awal');


			$siswa=DB::select("select a.*,c.* from siswa_rombel a,
			siswa c where kd_rombel='$awal'
			and kd_rombel in(select b.kd_rombel from nilai_ujian b
                 where b.kd_rombel=a.kd_rombel)
                 and c.nis=a.nis");

			$kelas=Kelas::find(Input::get('awal'));

			//cari data kelas yang tingkatnya sama dengan data kelas sekarang
			if($kelas->kelas=='7'){
				$lain=DB::table('kelas')
						->where('kelas','=','8')
						->get();
			}else if($kelas->kelas=='8'){
				$lain=DB::table('kelas')
						->where('kelas','=','9')
						->get();
			}else{
				$lain="";
			}


			if(count($siswa)>0){
				return View::make('kenaikan.get_siswa_tinggal')
					->with('siswa',$siswa)
					->with('awal',$awal)
					->with('setting',$setting)
					->with('lain',$lain);
			}else{
				echo "<div class='alert alert-danger'>Tidak ada data</div>";
			}
		}
	}

	public function simpan_tinggal_kelas(){
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
				'status'=>3,
			);
			DB::table('riwayat_rombel')->insert($riwayat);
		}

		$html=count($pilih)." Proses Kenaikan siswa berhasil<br>";
		Session::flash('pesan',$html);

		return View::make('mutasi.mutasi_sukses')
			->with('pilih',$pilih);
	}



}
