<?php

class GuruController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$guru=Guru::all();

		return View::make('guru.index')
			->with('guru',$guru);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('guru.tambah');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input=Input::all();

		$validasi=Validator::make($input,Guru::$rules,Guru::$pesan);

		if($validasi->fails()){
			return Redirect::to('admin/guru/create')
				->withInput()
				->withErrors($validasi);
		}else{
			$guru=new Guru;
				$guru->id=Input::get('id');
				$guru->nip=Input::get('nip');
				$guru->nuptk=Input::get('nuptk');
				$guru->nm_guru=Input::get('nama');
				$guru->tmp_lahir=Input::get('tempat');
				$guru->tgl_lahir=date('Y-m-d',strtotime(Input::get('tanggal')));
				$guru->jk=Input::get('jk');
				$guru->pend_terakhir=Input::get('pendidikan');
				$guru->tahun=Input::get('tahun');
				$guru->mulai_kerja=date('Y-m-d',strtotime(Input::get('mulai')));
				$guru->email=Input::get('email');

				if(Input::hasFile('foto')){
					$file=Input::file('foto');
					$filename=str_random(5).'-'.$file->getClientOriginalName();
					$destinationPath='uploads/guru/';
					$file->move($destinationPath,$filename);
					$guru->foto=$filename;
				}

				$guru->save();

				//membuat guru baru
				$guru=Sentry::register(array(
					'password'=>Input::get('id'),
					'username'=>Input::get('id')
				),true);

				//cari group berdasarkan nama=guru
				$guruGroup=Sentry::findGroupByName('guru');

				//masukan user ke group guru
				$guru->addGroup($guruGroup);

				return Redirect::to('admin/guru')
					->with('pesan',"<hr><div class='alert alert-info'>
						Data Berhasil disimpan</div>");
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
		$guru=Guru::find($id);

		return View::make('guru.view')
			->with('guru',$guru);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$guru=Guru::find($id);

		return View::make('guru.edit')
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
		$guru=Guru::findOrFail($id);

		$input=Input::all();

		$validasi=Validator::make($input,$guru->updateRules(),Guru::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$guru->id=Input::get('id');
			$guru->nip=Input::get('nip');
			$guru->nuptk=Input::get('nuptk');
			$guru->nm_guru=Input::get('nama');
			$guru->tmp_lahir=Input::get('tempat');
			$guru->tgl_lahir=date('Y-m-d',strtotime(Input::get('tanggal')));
			$guru->jk=Input::get('jk');
			$guru->pend_terakhir=Input::get('pendidikan');
			$guru->tahun=Input::get('tahun');
			$guru->mulai_kerja=date('Y-m-d',strtotime(Input::get('mulai')));
			$guru->email=Input::get('email');

			if(Input::hasFile('foto')){
				$file=Input::file('foto');
				$filename=str_random(5).'-'.$file->getClientOriginalName();
				$destinationPath='uploads/guru/';
				$file->move($destinationPath,$filename);
				

				if($guru->foto){
					$fotolama=$guru->foto;
					$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/guru'.DIRECTORY_SEPARATOR.$guru->foto;

					try{
						File::delete($filepath);
					}catch(FileNotFoundException $e){

					}
				}

				$guru->foto=$filename;
			}

			$guru->save();

			return Redirect::to('admin/guru/'.$id.'/edit')
				->with('pesan',"<hr><div class='alert alert-info'>
					Data Berhasil disimpan</div>");
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
		$rombel=DB::table('rombel')->where('id_wali','=',$id)->count();
		$mengajar=DB::table('mengajar')->where('id_guru','=',$id)->count();

		if($rombel>0 && $mengajar>0){
			$html="<hr><div class='alert alert-danger'>Data Guru masih ada relasi 
			dengan Data Rombel dan Data Mengajar</div>";
		}else if($rombel>0){
			$html="<hr><div class='alert alert-danger'>Data Guru tidak dapat dihapus
			karena Masih ada relasi dengan
			data Rombel <ul>";

			$data=DB::table('rombel')->where('id_wali','=',$id)->get();

			foreach($data as $row){
				$html.="<li>".$row->kd_rombel."</li>";
			}

			$html.="</ul></div>";

			Session::flash('pesan',$html);
			return Redirect::back();
		}else if($mengajar>0){
			$html="<hr><div class='alert alert-danger'>Data Guru tidak dapat dihapus
			karena Masih ada relasi dengan
			data Mengajar <ul>";

			$data=DB::table('mengajar')->where('id_guru','=',$id)->get();

			foreach($data as $row){
				$html.="<li>".$row->id_mengajar."</li>";
			}

			$html.="</ul></div>";

			Session::flash('pesan',$html);
			return Redirect::back();
		}else{
			$guru=Guru::find($id);

			if($guru->foto){
				$fotolama=$guru->foto;
				$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/guru'.DIRECTORY_SEPARATOR.$guru->foto;

				try{
					File::delete($filepath);
				}catch(FileNotFoundException $e){

				}
			}

			$guru->delete();
			return Redirect::to('admin/guru')
				->with('pesan',"<hr><div class='alert alert-info'>Data Berhasil dihapus</div>");
		}
	}

	public function form_import(){
		return View::make('guru.import');
	}

	public function proses_import(){
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
				'id'=>'required',
				'nm_guru'=>'required'
			];

			foreach($excels as $row){
				//membuat validasi untuk row di excel
				//jangan lupa mengubah $row menjadi array
				$validasi=Validator::make($row->toArray(),$rowRules);

				//skip baris ini jika tidak valid, langsung ke baris berikutnya
				if($validasi->fails()) continue;

				$cek=DB::table('guru')->where('id','=',$row['id'])->count();

				if($cek>0) continue;

				$data=array(
					'id'=>$row['id'],
					'nip'=>$row['nip'],
					'nuptk'=>$row['nuptk'],
					'nm_guru'=>$row['nm_guru']
				);

				DB::table('guru')->insert($data);

				//membuat guru baru
				$guru=Sentry::register(array(
					'password'=>$row['id'],
					'username'=>$row['id']
				),true);

				//cari group berdasarkan nama=guru
				$guruGroup=Sentry::findGroupByName('guru');

				//masukan user ke group guru
				$guru->addGroup($guruGroup);

				$counter++;
			}

			Session::flash('pesan',"<hr><div class='alert alert-info'>
				Berhasil mengimport ".$counter." guru</div>");

			return Redirect::to('admin/guru');
		}
	}


}
