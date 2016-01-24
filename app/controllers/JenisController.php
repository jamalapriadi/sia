<?php

class JenisController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jenis=Jenis::all();

		return View::make('jenis.index')
			->with('jenis',$jenis);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('jenis.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validasi=Validator::make(Input::all(),Jenis::$rules,Jenis::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$cek=DB::table('jenis_nilai')->where('kd_jenis','=',Input::get('kode'))->count();
			if($cek>0){
				Session::flash('pesan',"<div class='alert alert-danger'>
				Kode jenis sudah ada</div>");
				return Redirect::back();
			}else{
				$jenis=new Jenis;
				$jenis->kd_jenis=Input::get('kode');
				$jenis->nm_jenis=Input::get('nama');
				$jenis->save();

				Session::flash('pesan',"<div class='alert alert-info'>
				Jenis nilai berhasil disimpan</div>");
				return Redirect::to('admin/jenis');
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
		$jenis=Jenis::find($id);
		return View::make('jenis.edit')
			->with('jenis',$jenis);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validasi=Validator::make(Input::all(),Jenis::$rules,Jenis::$pesan);

		if($validasi->fails()){
			return Redirect::back()
			->withInput()
			->withErrors($validasi);
		}else{
			$jenis=Jenis::find($id);
			$jenis->kd_jenis=Input::get('kode');
			$jenis->nm_jenis=Input::get('nama');
			$jenis->save();

			Session::flash('pesan',"<div class='alert alert-info'>
			Jenis nilai berhasil disimpan</div>");
			return Redirect::to('admin/jenis');
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
		$cek=DB::table('nilai_harian')->where('kd_jenis','=',$id)->count();
		if($cek>0){
			Session::flash('pesan',"<div class='alert alert-danger'>
			Jenis nilai tidak dapat dihapus karena ada relasi dengan tabel
			nilai harian</div>");

			return Redirect::back();
		}else{
			Jenis::find($id)->delete();
			Session::flash('pesan',"<div class='alert alert-info'>
			Jenis nilai Berhasil dihapus</div>");
			return Redirect::back();
		}
	}


}
