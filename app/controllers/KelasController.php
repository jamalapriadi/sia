<?php

class KelasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$kelas=Kelas::all();
		return View::make('kelas.index')
			->with('kelas',$kelas);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('kelas.tambah');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input=Input::all();

		$aturan=array(
			'kelas'=>'required',
			'sub'=>'required'
		);

		$pesan=array(
			'kelas.required'=>'Kelas harus diisi',
			'sub.required'=>'Sub Kelas harus diisi'
		);

		$validasi=Validator::make($input,$aturan,$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			//simpan
			$kode=Input::get('kelas')."-".Input::get('sub');

			$cek=Kelas::where('kd_kelas','=',$kode)->count();

			if($cek>0){
				return Redirect::back()
					->withInput()
					->with('pesan',"<div class='alert alert-danger'>Kode Kelas sudah digunakan</div>");
			}else{
				$kelas=new Kelas;
				$kelas->kd_kelas=$kode;
				$kelas->kelas=Input::get('kelas');
				$kelas->subkelas=Input::get('sub');

				$kelas->save();

				return Redirect::to('admin/kelas')
					->with('pesan',"<hr><div class='alert alert-info'>Data Berhasil disimpan</div>");
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
		return Redirect::to('admin/kelas')
			->with('pesan',"<hr><div class='alert alert-info'>Kelas tidak dapat diedit</div>");
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return Redirect::to('admin/kelas')
			->with('pesan',"<hr><div class='alert alert-info'>Kelas tidak dapat diedit</div>");
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return Redirect::to('admin/kelas')
			->with('pesan',"<hr><div class='alert alert-info'>Kelas tidak dapat diedit</div>");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$rombel=DB::table('rombel')->where('kd_kelas','=',$id)->count();

		if($rombel>0){
			$html="<hr><div class='alert alert-danger'>Kelas masih ada relasi dengan data Rombel : <ul>";

			$data=DB::table('rombel')->where('kd_kelas','=',$id)->get();

			foreach($data as $row){
				$html.="<li>".$row->kd_rombel."</li>";
			}

			$html.="</ul></div>";

			Session::flash('pesan',$html);

			return Redirect::back();
		}else{
			Kelas::find($id)->delete();

			return Redirect::to('admin/kelas')
				->with('pesan',"<hr><div class='alert alert-info'>
					Data Berhasil dihapus</div>");
		}
	}


}
