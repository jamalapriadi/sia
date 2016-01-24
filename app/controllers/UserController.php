<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user=DB::table('users_groups')
			->join('users','users.id','=','users_groups.user_id')
			->join('groups','groups.id','=','users_groups.group_id')
			->select('users.id as iduser','users.username',
			'users.activated','users.activated_at','users.last_login',
			'groups.name')
			->get();

		return View::make('user.index')
			->with('user',$user);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			'username'=>'required',
			'email'=>'required|email',
			'password'=>'required'
		);

		$pesan=array(
			'username.required'=>'Username harus diisi',
			'email.required'=>'Email harus diisi',
			'password.required'=>'Password harus diisi'
		);

		$validasi=Validator::make(Input::all(),$rules,$pesan);
		if($validasi->fails()){
			return Redirect::back()
				->withErrors($validasi)
				->withInput();
		}else{
			$cekUser=DB::table('users')
				->where('email','=',Input::get('email'))
				->count();
			if($cekUser>0){
				Session::flash('pesan',"<div class='alert alert-danger'>
				Email sudah digunakan</div>");
				return Redirect::back();
			}else{
				//membuat admin baru
				$admin=Sentry::register(array(
					'email'=>Input::get('email'),
					'password'=>Input::get('password'),
					'username'=>Input::get('username')
				),true);

				//cari group admin
				$adminGroup=Sentry::findGroupByName('admin');

				//masukan user ke group admin
				$admin->addGroup($adminGroup);

				Session::flash('pesan',"<div class='alert alert-danger'>
				User berhasil ditambah</div>");
				return Redirect::to('admin/user');
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
		//
	}

	public function aktivasi(){
		if(Request::ajax()){
			$id=Input::get('user');

			$user=User::find($id);
			$user->activated=1;
			$user->activated_at=date('Y-m-d H:i:s');
			$user->save();

			Session::flash('pesan',"<div class='alert alert-info'>
			User ".$user->email." Berhasil diaktivasi</div>");
		}
	}

	public function nonaktif(){
		if(Request::ajax()){
			$id=Input::get('user');

			$user=User::find($id);
			$user->activated=0;
			$user->save();

			Session::flash('pesan',"<div class='alert alert-info'>
			User ".$user->email." Berhasil di non aktifkan</div>");
		}
	}


}
