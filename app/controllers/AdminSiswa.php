<?php
class AdminSiswa extends BaseController{
  public function index(){
    return View::make('hal_siswa.index');
  }

  public function jadwal(){
    $jadwal=DB::table('jadwal')
    ->groupBy('hari')
    ->get();

    $rombel=DB::table('siswa_rombel')
      ->where('nis','=',Sentry::getUser()->username)
      ->get();

    return View::make('hal_siswa.tampil_jadwal')
    ->with('jadwal',$jadwal)
    ->with('rombel',$rombel);
  }

  public function rombel(){
    $rombel=DB::table('siswa_rombel')
      ->where('nis','=',Sentry::getUser()->username)
      ->get();

    return View::make('hal_siswa.rombel')
    ->with('rombel',$rombel);
  }

  public function get_rombel(){
    if(Request::ajax()){
      $id=Input::get('rombel');
      $rombel=Rombel::find($id);
      $detail=DB::table('siswa_rombel')->where('kd_rombel','=',$id)
      ->join('siswa','siswa_rombel.nis','=','siswa.nis')->get();

      return View::make('hal_guru.get_rombel')
      ->with('rombel',$rombel)
      ->with('detail',$detail);
    }
  }

  public function mengajar(){
    $guru=Guru::all();
    return View::make('hal_siswa.mengajar')
    ->with('guru',$guru);
  }

  public function get_guru(){
    if(Request::ajax()){
      $nip=Input::get('nip');
      $guru=Guru::find($nip);

      return $guru->nm_guru;
    }
  }

  public function get_mengajar(){
    if(Request::ajax()){
      $nip=Input::get('nip');

      $ngajar=DB::table('mengajar')
        ->where('id_guru','=',$nip)
        ->get();


      return View::make('hal_guru.get_mengajar')
      ->with('ngajar',$ngajar);
    }
  }

  public function n_harian(){
    $siswa=Siswa::find(Sentry::getUser()->username);

    $rombel=DB::table('nilai_harian')
      ->where('nis',Sentry::getUser()->username)
      ->groupBy('kd_rombel')->get();

    return View::make('hal_siswa.n_harian')
      ->with('rombel',$rombel);
  }

  public function cetak_n_harian(){
    $rombel=Input::get('rombel');
    $semester=Input::get('semester');

    $siswa=Siswa::where('nis',Sentry::getUser()->username)->first();

    $nilai=DB::table('nilai_harian')->where('kd_rombel','=',$rombel)
      ->where('semester','=',$semester)
      ->where('nis',Sentry::getUser()->username)
      ->groupBy('kd_mapel')
      ->get();


    $kelas=Rombel::find($rombel);


    return View::make('hal_siswa.cetak_harian')
      ->with('siswa',$siswa)
      ->with('kelas',$kelas)
      ->with('semester',$semester)
      ->with('nilai',$nilai)
      ->with('title','Laporan Nilai Harian');
  }

  public function n_ujian(){
    $siswa=Siswa::where('nis',Sentry::getUser()->username)->first();

    $rombel=DB::table('nilai_ujian')
      ->where('nis',Sentry::getUser()->username)
      ->groupBy('kd_rombel')
      ->get();

    return View::make('hal_siswa.n_ujian')
    ->with('rombel',$rombel);
  }

  public function cetak_n_ujian(){
    $rombel=Input::get('rombel');
    $semester=Input::get('semester');
    $user=Sentry::getUser()->email;

    $siswa=Siswa::where('nis',Sentry::getUser()->username)->first();

    $nilai=DB::table('nilai_ujian')->where('kd_rombel','=',$rombel)
      ->where('semester','=',$semester)
      ->where('nis',Sentry::getUser()->username)
      ->groupBy('kd_mapel')
      ->get();


    $kelas=Rombel::find($rombel);


    return View::make('hal_siswa.cetak_ujian')
    ->with('nilai',$nilai)
    ->with('rombel',$rombel)
    ->with('nis',$siswa)
    ->with('kelas',$kelas)
    ->with('semester',$semester)
    ->with('title','Laporan Nilai Ujian');
  }

  public function n_raport(){
    $siswa=Siswa::where('nis',Sentry::getUser()->username)->first();

    $rombel=DB::table('nilai_ujian')
    ->where('nis',Sentry::getUser()->username)
    ->groupBy('kd_rombel')
    ->get();

    return View::make('hal_siswa.n_raport')
    ->with('rombel',$rombel);
  }

  public function cetak_raport(){
    $rombel=Input::get('rombel');
    $semester=Input::get('semester');
    $siswa=Siswa::where('nis',Sentry::getUser()->username)->first();
    $setting=DB::table('setting')->first();


    $nilai=DB::table('nilai_ujian')->where('kd_rombel','=',$rombel)
          ->where('nis',$siswa->nis)
          ->where('semester',$semester)
          ->groupBy('kd_mapel')
          ->get();

    $kelas=Rombel::find($rombel);

    return View::make('hal_siswa.cetak_raport')
    ->with('nilai',$nilai)
    ->with('rombel',$rombel)
    ->with('nis',$siswa)
    ->with('kelas',$kelas)
    ->with('semester',$semester)
    ->with('setting',$setting)
    ->with('title','Laporan Nilai Raport');
  }

  public function profile(){
    $user=Sentry::getUser()->email;

    $siswa=DB::select("select nis from siswa where email='$user'");
    foreach($siswa as $row){
      $nis=$row->nis;
    }

    $profile=Siswa::find($nis);

    return View::make('hal_siswa.profile')
      ->with('profile',$profile);
  }

  public function update_profile(){
    $siswa=Siswa::find(Input::get('nis'));
    $siswa->nm_siswa=Input::get('nama');
    $siswa->tmp_lahir=Input::get('tempat');
    $siswa->tgl_lahir=date('Y-m-d',strtotime(Input::get('tanggal')));
    $siswa->nm_ayah=Input::get('ayah');
    $siswa->nm_ibu=Input::get('ibu');
    $siswa->alamat=Input::get('alamat');
    $siswa->thn_sttb=Input::get('tahun');

    if(Input::hasFile('foto')){
      $file=Input::file('foto');
      $filename=str_random(5).'-'.$file->getClientOriginalName();
      $destinationPath='uploads/siswa/';
      $file->move($destinationPath,$filename);
      //$siswa->foto=$filename;

      if($siswa->foto){
        $fotolama=$siswa->foto;
        $filepath=public_path().DIRECTORY_SEPARATOR.'uploads/siswa'.DIRECTORY_SEPARATOR.$siswa->foto;

        try{
          File::delete($filepath);
        }catch(FileNotFoundException $e){

        }
      }

      $siswa->foto=$filename;
    }

    $siswa->save();
    Session::flash('pesan',"<div class='alert alert-info'>
    Data Berhasil diupdate</div>");
    return Redirect::back();
  }

  public function password(){
    return View::make('hal_siswa.password');
  }

  public function update_password(){
    $rules=array(
      'lama'=>'required',
      'password'=>'required|min:3|confirmed',
      'password_confirmation'=>'required|min:3'
    );

    $validasi=Validator::make(Input::all(),$rules);
    if($validasi->fails()){
      return Redirect::back()
      ->withInput()
      ->withErrors($validasi);
    }else{
      try
      {
        // Find the user using the user email address
        $email=Sentry::getUser()->email;
        $user = Sentry::findUserByLogin($email);

        if($user->checkPassword(Input::get('lama')))
        {
          $user->password = Input::get( 'password' );
          $user->save();
          Session::flash('pesan',"<div class='alert alert-success'>
          Password Berhasil diupdate</div>");
          return Redirect::back();
        }
        else
        {
          Session::flash('pesan',"<div class='alert alert-danger'>
          Password lama tidak sesuai</div>");
          return Redirect::back();
        }
      }
      catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
      {
        echo 'User tidak ada.';
      }
    }
  }

}
