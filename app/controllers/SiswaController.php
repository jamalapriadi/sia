<?php

class SiswaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$siswa=Siswa::all();

		return View::make('siswa.index')
			->with('siswa',$siswa);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$kelas=Kelas::all();
		$setting=Setting::first();

		return View::make('siswa.tambah')
			->with('kelas',$kelas)
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

		$validasi=Validator::make($input,Siswa::$rules,Siswa::$pesan);

		if($validasi->fails()){
			return Redirect::to('admin/siswa/create')
				->withInput()
				->withErrors($validasi);
		}else{
			$siswa=new Siswa;
				$siswa->nis=Input::get('nis');
				$siswa->nisn=Input::get('nisn');
				$siswa->nm_siswa=Input::get('nama');
				$siswa->jk=Input::get('jk');
				$siswa->tmp_lahir=Input::get('tempat');
				$siswa->tgl_lahir=date('Y-m-d',strtotime(Input::get('tanggal')));
				$siswa->agama=Input::get('agama');
				$siswa->nm_ayah=Input::get('ayah');
				$siswa->nm_ibu=Input::get('ibu');
				$siswa->alamat=Input::get('alamat');
				$siswa->thn_sttb=Input::get('tahun');
				$siswa->email=Input::get('email');

				if(Input::hasFile('foto')){
					$file=Input::file('foto');
					$filename=str_random(5).'-'.$file->getClientOriginalName();
					$destinationPath='uploads/siswa/';
					$file->move($destinationPath,$filename);
					$siswa->foto=$filename;
				}

				$siswa->save();

				//membuat siswa baru
				$siswa=Sentry::register(array(
					'password'=>Input::get('nis'),
					'username'=>Input::get('nis')
				),true);

				//cari group berdasarkan nama=siswa
				$siswaGroup=Sentry::findGroupByName('siswa');

				$siswa->addGroup($siswaGroup);

				$data=array(
					'kd_rombel'=>Input::get('tahun1').'-'.Input::get('tahun2').'-'.Input::get('kelas'),
					'nis'=>Input::get('nis')
				);

				DB::table('siswa_rombel')->insert($data);

				$riwayat=array(
					'ke_rombel'=>Input::get('tahun1').'-'.Input::get('tahun2').'-'.Input::get('kelas'),
					'nis'=>Input::get('nis'),
					'tanggal'=>Date('Y-m-d'),
					'status'=>1
				);
				DB::table('riwayat_rombel')->insert($riwayat);


				return Redirect::to('admin/siswa')
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
		$siswa=Siswa::find($id);
		$riwayat=DB::table('riwayat_rombel')->where('nis',$siswa->nis)->get();

		return View::make('siswa.view')
			->with('siswa',$siswa)
			->with('riwayat',$riwayat);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$siswa=Siswa::find($id);

		return View::make('siswa.edit')
			->with('siswa',$siswa);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$siswa=Siswa::findOrFail($id);

		$validasi=Validator::make(Input::all(),$siswa->updateRules(),Siswa::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
				$siswa->nis=Input::get('nis');
				$siswa->nisn=Input::get('nisn');
				$siswa->nm_siswa=Input::get('nama');
				$siswa->jk=Input::get('jk');
				$siswa->tmp_lahir=Input::get('tempat');
				$siswa->tgl_lahir=date('Y-m-d',strtotime(Input::get('tanggal')));
				$siswa->agama=Input::get('agama');
				$siswa->nm_ayah=Input::get('ayah');
				$siswa->nm_ibu=Input::get('ibu');
				$siswa->alamat=Input::get('alamat');
				$siswa->thn_sttb=Input::get('tahun');
				$siswa->email=Input::get('email');

				if(Input::hasFile('foto')){
					$file=Input::file('foto');
					$filename=str_random(5).'-'.$file->getClientOriginalName();
					$destinationPath='uploads/siswa/';
					$file->move($destinationPath,$filename);
					//$siswa->foto=$filename;

					if($siswa->foto){
						$fotolama=$siswa->foto;
						$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/siswa'.DIRECTORY_SEPARATOR.$siswa->foto;

						try{
							File::delete($filepath);
						}catch(FileNotFoundException $e){

						}
					}

					$siswa->foto=$filename;
				}

				$siswa->save();
				Session::flash('pesan',"<div class='alert alert-success'>
					Data berhasil dihapus</div>");


				return Redirect::to('admin/siswa/'.$siswa->id);
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
		$siswa=Siswa::find($id);

		$cek=DB::table('siswa_rombel')->where('nis','=',$siswa->nis)->count();
		$harian=DB::table('nilai_harian')->where('nis','=',$siswa->nis)->count();
		$ujian=DB::table('nilai_ujian')->where('nis','=',$siswa->nis)->count();

		if($cek>0 && $harian>0 && $ujian>0){
			$html="<div class='alert alert-danger'>Data tidak dapat dihapus
			karena ada relasi dengan tabel lain</div>";
			Session::flash('pesan',$html);
			return Redirect::back();
		}else if($cek>0){
			$html="<hr><div class='alert alert-danger'>Data Gagal dihapus
			karena masih memiliki relasi dengan data rombel<ul>";

			$rombel=DB::table('siswa_rombel')->where('nis','=',$id)->get();

			foreach($rombel as $row){
				$html.="<li>".$row->kd_rombel."</li>";
			}

			$html.="</ul></div>";
			Session::flash('pesan',$html);
			return Redirect::back();
		}else if($harian>0){
			$html="<hr><div class='alert alert-danger'>Data Gagal dihapus
			karena masih memiliki relasi dengan data nilai harian</div>";

			Session::flash('pesan',$html);
			return Redirect::back();
		}else if($ujian>0){
			$html="<hr><div class='alert alert-danger'>Data Gagal dihapus
			karena masih memiliki relasi dengan data nilai ujian</div>";

			Session::flash('pesan',$html);
			return Redirect::back();
		}else{
			$siswa=Siswa::find($id);

			if($siswa->foto){
				$fotolama=$siswa->foto;
				$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/siswa'.DIRECTORY_SEPARATOR.$siswa->foto;

				try{
					File::delete($filepath);
				}catch(FileNotFoundException $e){

				}
			}

			$siswa->delete();

			Session::flash('pesan',"<hr><div class='alert alert-info'>Data Siswa
				Berhasil dihapus</div>");

			return Redirect::back();
		}
	}

	public function form_import(){
		return View::make('siswa.import');
	}

	public function importExcel(){
		ini_set('max_execution_time', 300);

		$rules=['excel'=>'required'];

		$validasi=Validator::make(Input::all(),$rules);

		if($validasi->fails())
			return Redirect::back()->withErrors($validasi)->withInput();

		$excel=Input::file('excel');

		//ambil sheet pertama
		$excels=Excel::selectSheetsByIndex(0)->load($excel,function($reader){
			//options jika ada
		})->get();

		//digunakan untuk menghitung total siswa yang masuk
		$counter=0;

		$rowRules=[
			'nis'=>'required',
			'nm_siswa'=>'required',
			'jk'=>'required',
			//'tmp_lahir'=>'required',
			//'tgl_lahir'=>'required',
			//'agama'=>'required',
			//'nm_ayah'=>'required',
			//'nm_ibu'=>'required',
			//'alamat'=>'required',
			//'thn_sttb'=>'required',
		];

		foreach($excels as $row){
			//membuat validasi untuk row di excel
			//jangan lupa mengubah $row menjadi array
			$validasi=Validator::make($row->toArray(),$rowRules);

			//skip baris ini jika tidak valid, langsung ke baris berikutnya
			if($validasi->fails()) continue;

			$cek=DB::table('siswa')->where('nis','=',$row['nis'])->count();

			if($cek>0) continue;

			$data=array(
				'nis'=>$row['nis'],
				'nm_siswa'=>$row['nm_siswa'],
				'jk'=>$row['jk'],
				//'tmp_lahir'=>$row['tmp_lahir'],
				//'tgl_lahir'=>$row['tgl_lahir'],
				//'agama'=>$row['agama'],
				//'nm_ayah'=>$row['nm_ayah'],
				//'nm_ibu'=>$row['nm_ibu'],
				//'alamat'=>$row['alamat'],
				//'thn_sttb'=>$row['thn_sttb'],
			);

			DB::table('siswa')->insert($data);

			//membuat siswa baru
			$cekEmail=DB::table('users')
				->where('username','=',$row['nis'])
				->count();
			if($cekEmail>0) continue;

			$siswa=Sentry::register(array(
				'password'=>$row['nis'],
				'username'=>$row['nis']
			),true);

			//cari group berdasarkan nama=siswa
			$siswaGroup=Sentry::findGroupByName('siswa');

			$siswa->addGroup($siswaGroup);
			
			
			$data=array(
				'kd_rombel'=>$row['thn_ajaran'].'-'.$row['kelas'],
				'nis'=>$row['nis']
			);

			DB::table('siswa_rombel')->insert($data);

			$counter++;
		}

		Session::flash('pesan',"<hr><div class='alert alert-info'>
			Berhasil mengimport ".$counter." siswa</div>");

		return Redirect::to('admin/siswa');
	}

	public function generateExcel(){
		Excel::create('Template Import',function($excel){
			//set the properties
			$excel->setTitle('Template Data Siswa')
				->setCreator('Jamal Apriadi')
				->setCompany('SMP N 1 Pagerabarang')
				->setDescription('Untuk Import Data Siswa');

			$excel->sheet('Data Siswa',function($sheet){
				$row=1;
				$sheet->row($row,array(
					'nis',
					'nm_siswa',
					'jk'
				));
			});
		})->export('xls');
	}


}
