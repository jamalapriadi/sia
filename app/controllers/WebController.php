<?php
class WebController extends BaseController{

	public function sejarah(){
		return View::make('web.sejarah');
	}

	public function visi_misi(){
		return View::make('web.visi_misi');
	}

	public function data_guru(){
		$guru=Guru::all();

		return View::make('web.guru')
			->with('guru',$guru);
	}

	public function data_siswa(){
		$kelas=Kelas::all();

		return View::make('web.data_siswa')
			->with('kelas',$kelas);
	}

	public function get_kelas(){
		if(Request::ajax()){
			$kelas=Input::get('kelas');

			$cari=DB::table('rombel')
				->where('kd_kelas','=',$kelas)
				->get();

			echo "<option>--Pilih Tahun Ajaran</option>";
			foreach($cari as $row){
				echo "<option value='$row->thn_ajaran'>$row->thn_ajaran</option>";
			}
		}
	}

	public function tampil_rombel(){
		if(Request::ajax()){
			$kelas=Input::get('kelas');
			$tahun=Input::get('tahun');

			$pecah=explode('-', $tahun);

			$rombel=$tahun."-".$kelas;

			$siswa=DB::table('siswa_rombel')
				->where('kd_rombel','=',$rombel)
				->join('siswa','siswa.nis','=','siswa_rombel.nis')
				->get();

			echo "<table class='table table-striped'>
				<thead>
					<tr>
						<th>#</th>
						<th>NISN</th>
						<th>Nama</th>
						<th>JK</th>
					</tr>
				</thead>";

			$no=0;
			foreach($siswa as $row){
				$no++;
				echo "<tr>
					<td>$no</td>
					<td>$row->nis</td>
					<td>$row->nm_siswa</td>
					<td>$row->jk</td>
				</tr>";
			}
			echo "</table>";
		}
	}

	public function kontak(){
		$profile=Setting::first();

		return View::make('web.kontak')
			->with('profile',$profile);
	}

	public function berita(){
		$berita=Berita::all();
		return View::make('web.berita')
			->with('berita',$berita);
	}

	public function detail_berita($id){
		$berita=Berita::find($id);

		return View::make('web.detail_berita')
			->with('berita',$berita);
	}

	public function gallery(){
		$album=Album::all();

		return View::make('web.album')
			->with('album',$album);
	}

	public function detail_gallery($id){
		$album=Album::find($id);

		$detail=DB::table('detail_album')->where('id_album','=',$id)->get();

		return View::make('web.detailalbum')
			->with('album',$album)
			->with('detail',$detail);
	}


	public function login(){
		return View::make('login.index');
	}

	public function authenticate(){
		$input=Input::all();

		$aturan=array(
			'email'=>'required',
			'password'=>'required'
		);

		$pesan=array(
			'email.required'=>'Email harus diisi',
			'password.required'=>'Password harus diisi'
		);

		$validasi=Validator::make($input,$aturan,$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi)
				->with('pesan',"<div class='alert alert-danger'>
					Username atau Password Salah</div>");
		}else{
			$post=array(
				'username'=>Input::get('email'),
				'password'=>Input::get('password')
			);

			try{
				Sentry::authenticate($post,false);

				// Logged in successfully - redirect based on type of user
				$user = Sentry::getUser();
			    //$admin = Sentry::findGroupByName('admin');
			    //$users = Sentry::findGroupByName('member');

			    /*if($user->inGroup($admin)){
			    	return Redirect::intended('dashboard');
			    }else if($user->inGroup($users)){
			    	return Redirect::intended('member');
			    }*/

			    if($user->hasAccess('admin')){
			    	return Redirect::intended('admin/index');
			    }else if($user->hasAccess('guru')){
			    	return Redirect::intended('guru/index');
			    }else if($user->hasAccess('siswa')){
			    	return Redirect::intended('siswa/index');
			    }else{
			    	return Redirect::to('login')
			    		->with('pesan',"<div class='alert alert-info'>
			    			Login Gagal</div>");
			    }

			}catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
				Session::flash('pesan',"<div class='alert alert-danger'>
				Login field harus diisi</div>");
				return Redirect::back();
			}
			catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
				Session::flash('pesan',"<div class='alert alert-danger'>
				Password harus diisi</div>");
				return Redirect::back();
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
			{
				Session::flash('pesan',"<div class='alert alert-danger'>
				Password Salah, coba Lagi!</div>");
				return Redirect::back();
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				Session::flash('pesan',"<div class='alert alert-danger'>
				User tidak tersedia</div>");
				return Redirect::back();
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				Session::flash('pesan',"<div class='alert alert-danger'>
				User Belum diaktivasi</div>");
				return Redirect::back();
			}

			// The following is only required if the throttling is enabled
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
				Session::flash('pesan',"<div class='alert alert-danger'>
				User Suspend</div>");
				return Redirect::back();
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
				Session::flash('pesan',"<div class='alert alert-danger'>
				User ini sudah dibanned</div>");
				return Redirect::back();
			}
		}
	}

	public function logout(){
		Sentry::logout();
		return Redirect::to('login')
			->with('pesan',
				"<div class='alert alert-info'>
				Anda sudah Keluar</div>");
	}
}
