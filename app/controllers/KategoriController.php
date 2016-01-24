<?php

class KategoriController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$kategori=Kategori::all();

		return View::make('kategori.index')
			->with('kategori',$kategori);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('kategori.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validasi=Validator::make(Input::all(),Kategori::$rules,Kategori::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$kategori=new Kategori;
			$kategori->nm_kategori=Input::get('nama');

			$kategori->save();
			Session::flash('pesan',"<div class='alert alert-info'>
				Data Kategori Berhasil disimpan</div>");

			return Redirect::to('admin/kategori');
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
		$kategori=Kategori::find($id);

		return View::make('kategori.edit')
			->with('kategori',$kategori);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$kategori=Kategori::find($id);

		return View::make('kategori.edit')
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
		$validasi=Validator::make(Input::all(),Kategori::$rules,Kategori::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$kategori=Kategori::find($id);
			$kategori->nm_kategori=Input::get('nama');

			$kategori->save();
			Session::flash('pesan',"<div class='alert alert-info'>
				Data Kategori Berhasil diupdate</div>");

			return Redirect::to('admin/kategori');
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
		$berita=DB::table('berita')
			->where('id_kategori','=',$id)
			->count();

		if($berita>0){
			Session::flash('pesan',"<div class='alert alert-danger'>Data Kategori
				tidak dapat dihapus karena masih memiliki relasi dengan data berita</div>");
			return Redirect::to('admin/kategori');
		}else{
			Kategori::find($id)->delete();

			Session::flash('pesan',"<div class='alert alert-info'>Data berhasil dihapus</div>");
			return Redirect::to('admin/kategori');
		}
	}


}
