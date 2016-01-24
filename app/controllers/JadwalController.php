<?php
class JadwalController extends BaseController{
	public function index(){
		$setting=Setting::first();

		$rombel=DB::table('rombel')
			->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
			->get();



		return View::make('jadwal.index')
			->with('rombel',$rombel);
	}

	public function setting_jadwal($id){
		$rombel=Rombel::find($id);

		$jadwal=DB::table('jadwal')
			->where('kd_rombel','=',$rombel->kd_rombel)
			->get();
		$mapel=Mapel::all();

		return View::make('jadwal.setting')
			->with('rombel',$rombel)
			->with('mapel',$mapel);
	}

	public function cari_jam_jadwal(){
		if(Request::ajax()){
			$rombel=Input::get('rombel');
			$hari=Input::get('hari');
			$setting=Setting::first();

			if($hari=="Senin"){
				for($i=2;$i<=7;$i++){
					echo "<option value='$i'>$i</option>";
				}
			}else{
				$jam=Jam::all();

				echo "<option>--Pilih Jam--</option>";

				foreach($jam as $row){
					echo "<option value='$row->jam_ke'>$row->jam_ke</option>";
				}
			}
		}
	}

	public function get_jam(){
		if(Request::ajax()){
			$jam=Input::get('jam');

			$waktu=Jam::find($jam);

			echo $waktu->dari_jam."|".$waktu->sampai_jam;
		}
	}

	public function jadwal_get_guru(){
		if(Request::ajax()){
			$mapel=Input::get('mapel');

			$mengajar=DB::table('mengajar')->where('kd_mapel','=',$mapel)
				->join('guru','mengajar.id_guru','=','guru.id')->get();

			echo "<option>--Pilih Guru Mengajar--</option>";
			foreach($mengajar as $row){
				echo "<option value='$row->id_guru'>$row->nm_guru</option>";
			}
		}
	}

	public function simpan_jadwal(){
		if(Request::ajax()){
			$setting=Setting::first();

			$hari=Input::get('hari');
			$guru=Input::get('guru');
			$rombel=Input::get('rombel');
			$jam=Input::get('jam');
			$mapel=Input::get('mapel');

			$cek=DB::table('jadwal')->where('kd_rombel','=',$rombel)
				->where('hari','=',$hari)
				->where('jam_ke','=',$jam)
				->count();

			if($cek>0){
				echo "error";
			}else{
				//cek apakah guru ini sudah mengajar ditempat lain atau belum
				$cekguru=DB::table('jadwal')
					->where('kd_rombel','like',$setting->dari_tahun.'-'.$setting->sampai_tahun."%")
					->where('id_guru','=',$guru)
					->where('hari','=',$hari)
					->where('jam_ke','=',$jam)
					->where('kd_mapel','=',$mapel)
					->count();

				if($cekguru>0){
					echo "error2";
				}else{
					$jadwal=new Jadwal;
					$jadwal->kd_rombel=Input::get('rombel');
					$jadwal->hari=Input::get('hari');
					$jadwal->jam_ke=Input::get('jam');
					$jadwal->id_guru=Input::get('guru');
					$jadwal->kd_mapel=Input::get('mapel');

					$jadwal->save();

					echo "sukses";
				}
			}
		}
	}

	public function lihat_jadwal($id){
		$rombel=Rombel::find($id);

		$jadwal=DB::table('jadwal')
			->where('kd_rombel','=',$rombel->kd_rombel)
			->get();
		$mapel=Mapel::all();

		return View::make('jadwal.lihat')
			->with('rombel',$rombel)
			->with('mapel',$mapel);
	}


	public function hapus_jadwal(){
		if(Request::ajax()){
			$kode=Input::get('kode');

			Jadwal::find($kode)->delete();
		}
	}

	public function view(){
		if(Request::ajax()){
			$rombel=Rombel::find(Input::get('rombel'));

			$jadwal=DB::table('jadwal')
				->where('kd_rombel','=',$rombel->kd_rombel)
				->get();
			$mapel=Mapel::all();

			return View::make('hal_siswa.view_jadwal')
				->with('rombel',$rombel)
				->with('mapel',$mapel);
		}
	}
}
