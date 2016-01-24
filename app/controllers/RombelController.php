<?php

class RombelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rombel=Rombel::all();

		return View::make('rombel.index')
			->with('rombel',$rombel);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$kelas=Kelas::all();
		$guru=Guru::all();
		$setting=Setting::first();

		return View::make('rombel.tambah')
			->with('kelas',$kelas)
			->with('guru',$guru)
			->with('setting',$setting);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input=Input::all();

		$validasi=Validator::make($input,Rombel::$rules,Rombel::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$kode=Input::get('tahun')."-".Input::get('kelas');

			$cek=DB::table('rombel')->where('kd_rombel','=',$kode)->count();

			if($cek>0){
				return Redirect::back()
					->withInput()
					->with('pesan',"<div class='alert alert-danger'>
						Kelas ini sudah ada</div>");
			}else{
				$cekguru=DB::table('rombel')
					->where('thn_ajaran','=',Input::get('tahun'))
					->where('id_wali','=',Input::get('nip'))
					->count();
				if($cekguru>0){
					return Redirect::back()
						->withInput()
						->with('pesan',"<div class='alert alert-danger'>
						Nip ini sudah menjadi walikelas di Rombel lain</div>");
				}else{
					$rombel=new Rombel;

					$rombel->kd_rombel=Input::get('tahun')."-".Input::get('kelas');
					$rombel->kd_kelas=Input::get('kelas');
					$rombel->thn_ajaran=Input::get('tahun');
					$rombel->id_wali=Input::get('nip');

					$rombel->save();
					return Redirect::to('admin/rombel')
					->with('pesan',"<hr>
					<div class='alert alert-info'>Data Berhasil disimpan</div>");
				}
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

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$rombel=Rombel::find($id);
		$kelas=Kelas::all();
		$guru=Guru::all();

		return View::make('rombel.edit')
			->with('rombel',$rombel)
			->with('kelas',$kelas)
			->with('guru',$guru);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validasi=Validator::make(Input::all(),Rombel::$rules,Rombel::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$rombel=Rombel::find($id);
			$rombel->kd_kelas=Input::get('kelas');
			$rombel->thn_ajaran=Input::get('tahun');
			$rombel->id_wali=Input::get('nip');

			$rombel->save();

			Session::flash('pesan',"<hr><div class='alert alert-info'>
				Rombel Berhasil diupdate</div>");
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
		//cek relasi ke tabel mengajar
		$detail=DB::table('siswa_rombel')->where('kd_rombel','=',$id)->count();

		if($detail>0){
			$html="<hr><div class='alert alert-danger'> Data Rombel tidak dapat dihapus
			karena masih ada relasi dengan detail rombel</div>";

			Session::flash('pesan',$html);
			return Redirect::to('admin/rombel');
		}else{
			Rombel::find($id)->delete();
			Session::flash('pesan',"<hr><div class='alert alert-info'>Data Berhasil dihapus</div>");

			return Redirect::to('admin/rombel');
		}
	}

	public function tambah_siswa($id){
		$rombel=Rombel::find($id);
		$siswa=Siswa::all();

		$detail=DB::table('siswa_rombel')
			->where('kd_rombel','=',$id)
			->join('siswa','siswa.nis','=','siswa_rombel.nis')
			->get();

		return View::make('rombel.tambah_siswa')
			->with('rombel',$rombel)
			->with('siswa',$siswa)
			->with('detail',$detail);
	}

	public function cari_siswa(){
		$kode=Input::get('term');

		$setting=Setting::first();

		$tahun=$setting->thn_ajaran;


		$siswa=DB::select("select * from siswa where nis like '$kode%'
					and nis not in(select nis from detail_rombel
						where kd_rombel like '$tahun%'
					               and detail_rombel.nis=siswa.nis)
												limit 10");

		$nis=array();

		foreach($siswa as $row){
			$nis[]=$row->nis;
		}

		echo json_encode($nis);
	}

	public function get_siswa(){
		if(Request::ajax()){
			$nis=Input::get('nis');

			$siswa=Siswa::find($nis);

			echo $siswa->nm_siswa."|".$siswa->jk;
		}
	}

	public function simpan_siswa(){
		if(Request::ajax()){
			$nis=Input::get('nis');

			$siswa=DB::table('siswa')->where('nis','=',$nis)->count();

			if($siswa>0){
				$cekRombel=DB::table('detail_rombel')
					->where('kd_rombel','=',Input::get('rombel'))
					->where('nis','=',$nis)
					->count();

				if($cekRombel>0){
					Session::flash('pesan',"<hr><div class='alert alert-danger'>
						Nis ini sudah ada dalam rombel</div>");
				}else{
					$rombel=explode('-',Input::get('rombel'));

					$ceksiswarombel=DB::table('detail_rombel')
						->where('kd_rombel','like',$rombel[0]."%")
						->where('nis','=',Input::get('nis'))
						->count();
					if($ceksiswarombel>0){
						Session::flash('pesan',"<hr><div class='alert alert-danger'>Nis ini sudah ada di rombel lain</div>");
					}else{
						$data=array(
							'kd_rombel'=>Input::get('rombel'),
							'nis'=>Input::get('nis')
						);

						DB::table('detail_rombel')->insert($data);

						Session::flash('pesan',"<hr><div class='alert alert-info'>Data Berhasil
						disimpan</div>");
					}

				}
			}
		}
	}

	public function hapus_siswa(){
		if(Request::ajax()){
			$nis=Input::get('nis');
			$rombel=Input::get('rombel');

			$harian=DB::table('nilai_harian')
				->where('nis','=',$nis)
				->count();

			$ujian=DB::table('nilai_ujian')
				->where('nis','=',$nis)
				->count();

			if($harian>0 && $ujian>0){
				Session::flash('pesan',"<div class='alert alert-danger'>
					Data Siswa tidak dapat dihapus karena masih ada relasi dengan
					tabel nilai harian dan nilai ujian</div>");
			}else if($harian>0){
				Session::flash('pesan',"<div class='alert alert-danger'>
					Data Siswa tidak dapat dihapus karena ada relasi dengan data
					nilai harian</div>");
			}else if($ujian>0){
				Session::flash('pesan',"<div class='alert alert-danger'>
					Data Siswa tidak dapat dihapus karena ada relasi dengan data
					nilai ujian</div>");
			}else{
				DB::table('siswa_rombel')
					->where('kd_rombel','=',$rombel)
					->where('nis','=',$nis)
					->delete();

				Session::flash('pesan',"<div class='alert alert-info'>
					Data Berhasil dihapus</div>");
			}
		}
	}

	public function import(){
		ini_set('max_execution_time', 300);
		$input=Input::all();
		$rules=['excel'=>'required'];
		$pesan=['excel.required'=>'File excel harus diisi'];

		$validasi=Validator::make($input,$rules,$pesan);

		if($validasi->fails()){
			Session::flash('pesan',"<div class='alert alert-danger'>Pilih File yang akan diimport</div>");
			return Redirect::back()
			->withInput();
		}else{
			$excel=Input::file('excel');

			//ambil sheet pertama
			$excels=Excel::selectSheetsByIndex(0)->load($excel,function($reader){
				//options jika ada
			})->get();

			//digunakan untuk menghitung total siswa yang masuk
			$counter=0;

			$rowRules=[
				'kd_rombel'=>'required',
				'nis'=>'required'
			];

			foreach($excels as $row){
				//membuat validasi untuk row di excel
				//jangan lupa mengubah $row menjadi array
				$validasi=Validator::make($row->toArray(),$rowRules);

				//skip baris ini jika tidak valid, langsung ke baris berikutnya
				if($validasi->fails()) continue;
				if($row['kd_rombel']!=Input::get('rombel')) continue;

				$rombel=explode("-",$row['kd_rombel']);

				//cek siswa apakah sudah ada di rombel tertentu pada tahun ajaran sekian
				$siswarombel=DB::table('detail_rombel')
					->where('kd_rombel','like',$rombel[0]."%")
					->where('nis','=',$row['nis'])
					->count();
				//jika sudah ada maka proses dilanjutkan tanpa save data ke detail rombel
				if($siswarombel>0) continue;

				$cek=DB::table('detail_rombel')->where('kd_rombel','=',$row['kd_rombel'])
				->where('nis','=',$row['nis'])->count();

				if($cek>0) continue;

				$data=array(
					'kd_rombel'=>$row['kd_rombel'],
					'nis'=>$row['nis']
				);

					DB::table('detail_rombel')->insert($data);
					$counter++;
				}

				Session::flash('pesan',"<hr><div class='alert alert-info'>
					Berhasil mengimport ".$counter." siswa</div>");

					return Redirect::back();
				}

			}
}
