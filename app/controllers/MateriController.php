<?php

class MateriController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user=Sentry::getUser()->username;

		$materi=DB::table('materi')
			->where('created_by','=',$user)
			->get();
		return View::make('materi.index')
			->with('materi',$materi);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('materi.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=['judul'=>'required'];
		$pesan=['judul.required'=>'Judul harus diisi'];

		$validasi=Validator::make(Input::all(),$rules,$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$materi=new Materi;
			$materi->judul_materi=Input::get('judul');
			$materi->created_by=Sentry::getUser()->username;

			if(Input::hasFile('file')){
				$file=Input::file('file');
				$filename=str_random(5).'-'.$file->getClientOriginalName();
				$destinationPath='uploads/materi/';
				$file->move($destinationPath,$filename);
				$materi->file=$filename;
			}

			$materi->save();

			Session::flash('pesan',"<div class='alert alert-info'>
			Materi Berhasil diupload</div>");

			return Redirect::to('guru/materi');
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
		$materi=Materi::find($id);

		return View::make('materi.edit')
			->with('materi',$materi);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules=['judul'=>'required'];
		$pesan=['judul.required'=>'Judul harus diisi'];

		$validasi=Validator::make(Input::all(),$rules,$pesan);

		if($validasi->fails()){
			return Redirect::back()
			->withInput()
			->withErrors($validasi);
		}else{
			$materi=Materi::find($id);
			$materi->judul_materi=Input::get('judul');
			$materi->created_by=Sentry::getUser()->username;

			if(Input::hasFile('file')){
				$file=Input::file('file');
				$filename=str_random(5).'-'.$file->getClientOriginalName();
				$destinationPath='uploads/materi/';
				$file->move($destinationPath,$filename);


				if($materi->file){
					$fotolama=$materi->file;
					$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/materi'.DIRECTORY_SEPARATOR.$materi->file;

					try{
						File::delete($filepath);
					}catch(FileNotFoundException $e){

					}
				}

				$materi->file=$filename;
			}

			$materi->save();

			Session::flash('pesan',"<div class='alert alert-info'>
			Materi Berhasil diupload</div>");

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
		$materi=Materi::find($id);

		if($materi->file){
			$fotolama=$materi->file;
			$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/materi'.DIRECTORY_SEPARATOR.$materi->file;

			try{
				File::delete($filepath);
			}catch(FileNotFoundException $e){

			}
		}

		$materi->delete();
		return Redirect::back()
		->with('pesan',"<hr><div class='alert alert-info'>Data Berhasil dihapus</div>");
	}


}
