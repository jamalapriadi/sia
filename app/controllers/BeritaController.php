<?php

class BeritaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$berita=Berita::all();

		return View::make('berita.index')
			->with('berita',$berita);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$kategori=Kategori::all();

		return View::make('berita.create')
			->with('kategori',$kategori);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validasi=Validator::make(Input::all(),Berita::$rules,Berita::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$berita=new Berita;
			$berita->judul=Input::get('judul');
			$berita->isi=Input::get('isi');
			$berita->id_kategori=Input::get('kategori');

			if(Input::hasFile('gambar')){
				$file=Input::file('gambar');
				$filename=str_random(5).'-'.$file->getClientOriginalName();
				$destinationPath='uploads/berita/';
				$file->move($destinationPath,$filename);
				$berita->gambar=$filename;
			}

			$berita->save();

			Session::flash('pesan',"<div class='alert alert-info'>Berita Berhasil disimpan</div>");

			return Redirect::to('admin/berita');
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
		$berita=Berita::find($id);
		$kategori=Kategori::all();

		return View::make('berita.edit')
			->with('berita',$berita)
			->with('kategori',$kategori);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validasi=Validator::make(Input::all(),Berita::$rules,Berita::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$berita=Berita::find($id);
			$berita->judul=Input::get('judul');
			$berita->isi=Input::get('isi');
			$berita->id_kategori=Input::get('kategori');

			if(Input::hasFile('gambar')){
				$file=Input::file('gambar');
				$filename=str_random(5).'-'.$file->getClientOriginalName();
				$destinationPath='uploads/berita/';
				$file->move($destinationPath,$filename);
				

				if($berita->gambar){
					$fotolama=$berita->gambar;
					$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/berita'.DIRECTORY_SEPARATOR.$berita->gambar;

					try{
						File::delete($filepath);
					}catch(FileNotFoundException $e){

					}
				}

				$berita->gambar=$filename;
			}



			$berita->save();

			Session::flash('pesan',"<div class='alert alert-info'>Berita Berhasil diupdate</div>");

			return Redirect::to('admin/berita');
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
		Berita::find($id)->delete();

		Session::flash('pesan',"<div class='alert alert-info'>
			Data Berhasil dihapus</div>");

		return Redirect::back();
	}


}
