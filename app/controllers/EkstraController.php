<?php

class EkstraController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ekstra=Ekstra::all();

		return View::make('ekstra.index')
			->with('ekstra',$ekstra);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ekstra.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'nama'=>'required'
		);
		$pesan=array(
			'nama.required'=>'Nama Ekstrakurikuler harus diisi'
		);

		$validasi=Validator::make(Input::all(),$rules,$pesan);
		if($validasi->fails()){
			return Redirect::back()
				->withErrors($validasi)
				->withInput();
		}else{
			$ekstra=new Ekstra;
			$ekstra->nm_ekstra=Input::get('nama');
			$ekstra->nip_pengampu=Input::get('nip');
			$ekstra->keterangan=Input::get('keterangan');

			if(Input::hasFile('logo')){
				$file=Input::file('logo');
				$filename=str_random(5).'-'.$file->getClientOriginalName();
				$destinationPath='uploads/ekstra/';
				$file->move($destinationPath,$filename);
				$ekstra->logo_ekstra=$filename;
			}

			$ekstra->save();
			Session::flash('pesan',"<div class='alert alert-success'>
			Data Ektrakurikuler berhasil disimpan</div>");
			return Redirect::to('admin/ekstrakurikuler');
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
		$ekstra=Ekstra::find($id);

		return View::make('ekstra.view')
			->with('ekstra',$ekstra);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ekstra=Ekstra::find($id);

		return View::make('ekstra.edit')
		->with('ekstra',$ekstra);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ekstra=Ekstra::find($id);
		$ekstra->nm_ekstra=Input::get('nama');
		$ekstra->nip_pengampu=Input::get('nip');
		$ekstra->keterangan=Input::get('keterangan');

		if(Input::hasFile('logo')){
			$file=Input::file('logo');
			$filename=str_random(5).'-'.$file->getClientOriginalName();
			$destinationPath='uploads/ekstra/';
			$file->move($destinationPath,$filename);


			if($ekstra->logo_ekstra){
				$fotolama=$ekstra->logo_ekstra;
				$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/ekstra'.DIRECTORY_SEPARATOR.$ekstra->logo_ekstra;

				try{
					File::delete($filepath);
				}catch(FileNotFoundException $e){

				}
			}

			$ekstra->logo_ekstra=$filename;
		}
		$ekstra->save();
		Session::flash('pesan',"<div class='alert alert-info'>
		Data Ekstra berhasil diupdate</div>");
		return Redirect::back();
	}



	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$ekstra=Ekstra::find($id);

		if($ekstra->logo_ekstra){
			$fotolama=$ekstra->logo_ekstra;
			$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/ekstra'.DIRECTORY_SEPARATOR.$ekstra->logo_ekstra;

			try{
				File::delete($filepath);
			}catch(FileNotFoundException $e){

			}
		}

		$ekstra->delete();
		return Redirect::back()
		->with('pesan',"<div class='alert alert-info'>Data Berhasil dihapus</div>");
	}


}
