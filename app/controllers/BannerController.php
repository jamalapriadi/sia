<?php

class BannerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$banner=DB::table('banner')->get();
		return View::make('banner.index')
			->with('banner',$banner);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$file=Input::file('file');

		foreach($file as $row) {
			$rules = array(
				'file' => 'required|mimes:png,gif,jpeg,txt,pdf,doc,rtf|max:20000'
			);
			$validator = \Validator::make(array('file'=> $row), $rules);
			if($validator->passes()){
				$destinationPath = 'uploads/banner';
				$filename = $row->getClientOriginalName();
				$mime_type = $row->getMimeType();
				$extension = $row->getClientOriginalExtension();
				$upload_success = $row->move($destinationPath, $filename);

				DB::insert('insert into banner (foto) values (?)', array($filename));

			} else {
				return Redirect::back()->with('error', 'I only accept images.');
			}
		}
		Session::flash('pesan',"<div class='alert alert-info'>
		File Berhasil diupload</div>");
		return Redirect::back();
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
		//
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
		$banner=Banner::find($id);

		if($banner->foto){
			$fotolama=$banner->foto;
			$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/banner'.DIRECTORY_SEPARATOR.$banner->foto;

			try{
				File::delete($filepath);
			}catch(FileNotFoundException $e){

			}
		}

		$banner->delete();
		return Redirect::to('admin/banner')
		->with('pesan',"<hr><div class='alert alert-info'>Data Berhasil dihapus</div>");
	}


}
