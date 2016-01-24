<?php

class MengajarController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$mengajar=Mengajar::all();

		return View::make('mengajar.index')
			->with('mengajar',$mengajar);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$guru=Guru::all();
		$mapel=Mapel::all();
		$setting=Setting::first();

		return View::make('mengajar.create')
			->with('guru',$guru)
			->with('mapel',$mapel)
			->with('setting',$setting);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validasi=Validator::make(Input::all(),Mengajar::$rules,Mengajar::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$cek=DB::table('mengajar')
				->where('id_guru','=',Input::get('guru'))
				->where('kd_mapel','=',Input::get('mapel'))
				->where('thn_ajaran','=',Input::get('tahun'))
				->count();

			if($cek>0){
				Session::flash('pesan',"<div class='alert alert-danger'>
					Data Ini sudah ada</div>");
				return Redirect::back()
					->withInput();
			}else{
				$mengajar=new Mengajar;
				$mengajar->id_guru=Input::get('guru');
				$mengajar->kd_mapel=Input::get('mapel');
				$mengajar->thn_ajaran=Input::get('tahun');
				$mengajar->save();

				Session::flash('pesan',"<hr><div class='alert alert-success'>
						Data Berhasil disimpan</div>");
				return Redirect::to('admin/mengajar');
			}
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$mengajar=Mengajar::find($id);
		$guru=Guru::all();
		$mapel=Mapel::all();
		$setting=Setting::first();

		return View::make('mengajar.edit')
			->with('mengajar',$mengajar)
			->with('guru',$guru)
			->with('mapel',$mapel)
			->with('setting',$setting);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validasi=Validator::make(Input::all(),Mengajar::$rules,Mengajar::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$mengajar=Mengajar::find($id);
			$mengajar->id_guru=Input::get('guru');
			$mengajar->kd_mapel=Input::get('mapel');
			$mengajar->thn_ajaran=Input::get('tahun');
			$mengajar->save();

			Session::flash('pesan',"<hr><div class='alert alert-success'>
					Data Berhasil update</div>");
			return Redirect::back();
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$jadwal=DB::table('jadwal')
			->where('id_guru','=',$id)->count();

		if($jadwal>0){
			Session::flash('pesan',"<hr><div class='alert alert-danger'>Data Mengajar
				tidak dapat dihapus karena masih ada relasi dengan data jadwal</div>");
			return Redirect::back();
		}else{
			Mengajar::find($id)->delete();
			Session::flash('pesan',"<hr><div class='alert alert-info'>Data Mengajar
				berhasil dihapus</div>");
			return Redirect::back();
		}

	}

	public function cari_nip(){
		if(Request::ajax()){
			$nip=Input::get('nip');

			$guru=Guru::find($nip);

			return $guru->nm_guru;
		}
	}

	public function cari_mengajar(){
		if(Request::ajax()){
			$nip=Input::get('nip');

			$mengajar=DB::table('mengajar')
				->where('id_mengajar','like','%'.$nip.'%')
				->get();

			return View::make('mengajar.tampil')
				->with('mengajar',$mengajar);
		}
	}

	public function simpan_mengajar(){
		if(Request::ajax()){
			$kode=Input::get('rombel')."-".Input::get('nip')."-".Input::get('mapel');

			$cek=DB::table('mengajar')
				->where('id_mengajar','=',$kode)->count();

			if($cek>0){
				echo "<div class='alert alert-danger'>Data Gagal
					disimpan, Id Mengajar sudah digunakan</div>";
			}else{
				$rombel=Input::get('rombel');
				$mapel=Input::get('mapel');

				//cek apakah kelas ini sudah ada pelajaran apa belum
				$cekada=DB::table('mengajar')
					->where('kd_rombel','=',$rombel)
					->where('kd_mapel','=',$mapel)
					->count();

				if($cekada>0){
					echo "<div class='alert alert-danger'>Rombel dan Mata Pelajaran sudah ada</div>";
				}else{
					$mengajar=new Mengajar;
					$mengajar->id_mengajar=$kode;
					$mengajar->nip=Input::get('nip');
					$mengajar->kd_rombel=Input::get('rombel');
					$mengajar->kd_mapel=Input::get('mapel');
					$mengajar->nilai_kkm=Input::get('nilai');
					$mengajar->save();

					echo "<div class='alert alert-success'>
						Data Berhasil disimpan</div>";
				}
			}
		}
	}

	public function hapus_mengajar(){
		if(Request::ajax()){
			$id=Input::get('kode');

			$harian=DB::table('nilai_harian')
				->where('id_mengajar','=',$id)->count();
			$ujian=DB::table('nilai_ujian')
				->where('id_mengajar','=',$id)->count();
			$jadwal=DB::table('jadwal')
				->where('id_mengajar','=',$id)->count();

			if($harian>0 && $ujian>0 && $jadwal>0){
				echo "<hr><div class='alert alert-danger'>Data Mengajar
					tidak dapat dihapus karena masih ada relasi dengan data nilai harian
					,nilai ujian dan data jadwal</div>";
			}elseif($harian>0){
				echo "<div class='alert alert-danger'>Data Mengajar
					tidak dapat dihapus karena masih ada relasi dengan data nilai harian</div>";
			}elseif($ujian>0){
				echo "<div class='alert alert-danger'>Data Mengajar
					tidak dapat dihapus karena masih ada relasi dengan data nilai ujian</div>";
			}elseif($jadwal>0){
				echo "<div class='alert alert-danger'>Data Mengajar
					tidak dapat dihapus karena masih ada relasi dengan data jadwal</div>";
			}else{
				Mengajar::find($id)->delete();
				echo "<div class='alert alert-info'>Data Mengajar
					berhasil dihapus</div>";
			}
		}
	}

	public function update_nilai(){
		if(Request::ajax()){
			$kode=Input::get('mengajar');
			$nilai=Input::get('nilai');

			$mengajar=Mengajar::find($kode);
			$mengajar->nilai_kkm=$nilai;
			$mengajar->save();

			return "<div class='alert alert-info'>Data Nilai KKM Berhasil diupdate</div>";
		}
	}

	public function form_import(){
		return View::make('mengajar.import');
	}

	public function import(){
		$rules=['excel'=>'required'];
		$pesan=['excel.required'=>'Pilih file terlebih dahulu'];

		$validasi=Validator::make(Input::all(),$rules,$pesan);

		if($validasi->fails()){
			echo "gagal";
		}else{
			$excel=Input::file('excel');

			//ambil sheet pertama
			$excels=Excel::selectSheetsByIndex(0)->load($excel,function($reader){
				//options jika ada
			})->get();
			$counter=0;

			$rowRules=[
				'nip'=>'required',
				'rombel'=>'required',
				'mapel'=>'required',
				'kkm'=>'required'
			];

			foreach($excels as $row){
				//membuat validasi untuk row di excel
				//jangan lupa mengubah $row menjadi array
				$validasi=Validator::make($row->toArray(),$rowRules);

				//skip baris ini jika tidak valid, langsung ke baris berikutnya
				if($validasi->fails()) continue;

				$cek=DB::table('mengajar')
					->where('id_mengajar','=',$row['rombel']."-".$row['nip']."-".$row['mapel'])
					->count();

				if($cek>0) continue;

				$data=array(
					'id_mengajar'=>$row['rombel']."-".$row['nip']."-".$row['mapel'],
					'kd_rombel'=>$row['rombel'],
					'nip'=>$row['nip'],
					'kd_mapel'=>$row['mapel'],
					'nilai_kkm'=>$row['kkm']
				);

				DB::table('mengajar')->insert($data);
				$counter++;
			}
			Session::flash('pesan',"<hr><div class='alert alert-info'>
				Berhasil mengimport ".$counter." data mengajar</div>");

			return Redirect::to('admin/mengajar');

		}
	}
}
