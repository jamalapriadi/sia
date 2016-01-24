<?php

class AlbumController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$album=Album::all();
		return View::make('album.index')
			->with('album',$album);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('album.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=['nama'=>'required'];
		$pesan=['nama.required'=>'Nama harus diisi'];
		$validasi=Validator::make(Input::all(),$rules,$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withErrors($validasi);
		}else{
			$album=new Album;
			$album->nm_album=Input::get('nama');
			$album->created_by=Sentry::getUser()->username;
			$album->save();

			$theId = DB::getPdo()->lastInsertId();

			return Redirect::to('admin/gallery/'.$theId.'/tambahfoto');
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
		$album=Album::find($id);

		return View::make('album.edit')
			->with('album',$album);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules=['nama'=>'required'];
		$pesan=['nama.required'=>'Nama harus diisi'];
		$validasi=Validator::make(Input::all(),$rules,$pesan);

		if($validasi->fails()){
			return Redirect::back()
			->withErrors($validasi);
		}else{
			$album=Album::find($id);
			$album->nm_album=Input::get('nama');
			$album->save();

			$theId = DB::getPdo()->lastInsertId();
			Session::flash('pesan',"<div class='alert alert-info'>
			Data Berhasil diupdate</div>");
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
		$album=Album::find($id);

		$cek=DB::table('detail_album')
			->where('id_album','=',$id)
			->count();

		if($cek>0){
			Session::flash('pesan',"<div class='alert alert-danger'>
			Data tidak dapat dihapus karena masih ada relasi dengan data detail album</div>");
			return Redirect::back();
		}else{
			$album->delete();
			Session::flash('pesan',"<div class='alert alert-info'>Data Berhasil dihapus</div>");
			return Redirect::back();
		}
	}

	public function tambahfoto($id){
		$album=Album::find($id);
		$detail=DB::table('detail_album')
			->where('id_album','=',$id)
			->get();

		return View::make('album.tambahfoto')
			->with('album',$album)
			->with('detail',$detail);
	}

	public function simpanfoto(){
		$file=Input::file('file');
		$album=Input::get('album');

		foreach($file as $row) {
			$rules = array(
				'file' => 'required|mimes:png,gif,jpeg,txt,pdf,doc,rtf|max:20000'
			);
			$validator = \Validator::make(array('file'=> $row), $rules);
			if($validator->passes()){
				$destinationPath = 'uploads/gallery';
				$filename = $row->getClientOriginalName();
				$mime_type = $row->getMimeType();
				$extension = $row->getClientOriginalExtension();
				$upload_success = $row->move($destinationPath, $filename);

				DB::insert('insert into detail_album
				 (id_album,foto) values (?,?)', array($album,$filename));

			} else {
				return Redirect::back()->with('error', 'I only accept images.');
			}
		}
		Session::flash('pesan',"<div class='alert alert-info'>
		File Berhasil diupload</div>");
		return Redirect::back();
	}

	public function hapusfoto(){
		if(Request::ajax()){
			$foto=Input::get('foto');

			$detail=Dalbum::find($foto);

			if($detail->foto){
				$fotolama=$detail->foto;
				$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/gallery'.DIRECTORY_SEPARATOR.$detail->foto;

				try{
					File::delete($filepath);
				}catch(FileNotFoundException $e){

				}
			}

			$detail->delete();
			Session::flash('pesan',"<div class='alert alert-info'>Data Berhasil dihapus</div>");
		}
	}


}
