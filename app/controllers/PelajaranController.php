<?php

class PelajaranController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$mapel=Mapel::all();

		return View::make('mapel.index')
			->with('mapel',$mapel);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('mapel.tambah');
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
			'kode'=>'required',
			'nama'=>'required'
		);

		$pesan=array(
			'kode.required'=>'Kode Mapel harus diisi',
			'nama.required'=>'Nama Mapel harus diisi'
		);

		$validasi=Validator::make($input,$aturan,$pesan);

		if($validasi->fails()){
			return Redirect::to('mapel/create')
				->withInput()
				->withErrors($validasi);
		}else{
			$cek=Mapel::where('kd_mapel','=',Input::get('kode'))->count();

			if($cek>0){
				return Redirect::to('admin/mapel/create')
					->withInput()
					->with('pesan',"<hr><div class='alert alert-danger'>
						Kode Mapel sudah digunakan</div>");
			}else{
				$mapel=new Mapel;
				$mapel->kd_mapel=Input::get('kode');
				$mapel->nm_mapel=Input::get('nama');

				$mapel->save();

				return Redirect::to('admin/mapel')
					->with('pesan',"<hr><div class='alert alert-info'>
						Data Berhasil disimpan</div>");
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
		$mapel=Mapel::find($id);

		return View::make('mapel.edit')
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
		$input=Input::all();

		$aturan=array(
			'kode'=>'required',
			'nama'=>'required'
		);

		$pesan=array(
			'kode.required'=>'Kode Mapel harus diisi',
			'nama.required'=>'Nama Mapel harus diisi'
		);

		$validasi=Validator::make($input,$aturan,$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$mapel=Mapel::find($id);
			$mapel->kd_mapel=Input::get('kode');
			$mapel->nm_mapel=Input::get('nama');

			$mapel->save();

			return Redirect::back()
				->withInput()
				->with('pesan',"<hr><div class='alert alert-info'>
					Data Berhasil diupdate</div>");
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
		$mengajar=DB::table('mengajar')->where('kd_mapel','=',$id)->count();

		if($mengajar>0){
			$html="<hr><div class='alert alert-danger'>Data Mapel tidak dapat dihapus
			karena masih ada relasi dengan data mengajar : <ul>";

			$data=DB::table('mengajar')->where('kd_mapel','=',$id)->get();

			foreach($data as $row){
				$html.="<li>".$row->id_mengajar."</li>";
			}

			$html.="</ul></div>";

			Session::flas('pesan',$html);
			return Redirect::back();
		}else{
			Mapel::find($id)->delete();

			return Redirect::to('admin/mapel')
				->with('pesan',"<hr><div class='alert alert-info'>
					Data Berhasil dihapus</div>");
		}
	}


}
