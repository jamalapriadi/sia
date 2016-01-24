<?php

class JamController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jam=Jam::all();

		return View::make('jam.index')
			->with('jam',$jam);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('jam.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validasi=Validator::make(Input::all(),Jam::$rules,Jam::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$cek=DB::table('jam_pelajaran')
				->where('jam_ke','=',Input::get('jam'))
				->count();

			if($cek>0){
				Session::flash('pesan',"<div class='alert alert-danger'>jam ini
					sudah ada</div>");
				return Redirect::back();
			}else{
				$jam=new Jam;
				$jam->jam_ke=Input::get('jam');
				$jam->dari_jam=Input::get('dari');
				$jam->sampai_jam=Input::get('sampai');

				$jam->save();

				Session::flash('pesan',"<hr><div class='alert alert-info'>Data Berhasil 
					disimpan</div>");
				return Redirect::to('admin/jam');
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
		return Redirect::back();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Jam::find($id)->delete();
		Session::flash('pesan',"<hr><div class='alert alert-info'>
			Data Berhasil dihapus</div>");

		return Redirect::back();
	}


}
