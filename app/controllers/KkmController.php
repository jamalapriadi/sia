<?php

class KkmController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$kkm=Kkm::all();

		return View::make('kkm.index')
			->with('kkm',$kkm);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$mapel=Mapel::all();
		$setting=Setting::first();
		return View::make('kkm.create')
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
		$validasi=Validator::make(Input::all(),Kkm::$rules,Kkm::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$cek=DB::table('kkm')->where('thn_ajaran','=',Input::get('tahun'))
				->where('kd_mapel','=',Input::get('mapel'))
				->count();

			if($cek>0){
				Session::flash('pesan',"<div class='alert alert-danger'>
				Mata Pelajaran ini sudah ada</div>");
				return Redirect::back();	
			}
			
			$kkm=new Kkm;
			$kkm->thn_ajaran=Input::get('tahun');
			$kkm->kd_mapel=Input::get('mapel');
			$kkm->nilai_kkm=Input::get('nilai');
			$kkm->save();

			Session::flash('pesan',"<div class='alert alert-success'>
				Data KKm berhasil disimpan</div>");

			return Redirect::to('admin/kkm');
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
		$kkm=Kkm::find($id);
		$mapel=Mapel::all();

		return View::make('kkm.edit')
			->with('kkm',$kkm)
			->with('mapel',$mapel);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validasi=Validator::make(Input::all(),Kkm::$rules,Kkm::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$kkm=Kkm::find($id);
			$kkm->nilai_kkm=Input::get('nilai');
			$kkm->save();


			Session::flash('pesan',"<div class='alert alert-success'>
				Data KKm berhasil diupdate</div>");

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
		Kkm::find($id)->delete();

		Session::flash('pesan',"<div class='alert alert-success'>
				Data KKm berhasil dihapus</div>");

			return Redirect::back();
	}


}
