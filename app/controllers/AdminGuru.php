<?php
class AdminGuru extends BaseController{
  public function index(){
    return View::make('hal_guru.index');
  }

  public function rombel(){
    $rombel=Rombel::all();

    return View::make('hal_guru.rombel')
      ->with('rombel',$rombel);
  }

  public function jadwal(){
    $jadwal=DB::table('jadwal')
    ->groupBy('hari')
    ->get();

    $rombel=Rombel::all();

    return View::make('hal_guru.tampil_jadwal')
    ->with('jadwal',$jadwal)
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
    return View::make('hal_guru.mengajar')
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
    $user=Sentry::getUser()->username;
    $setting=Setting::first();

    $jadwal=DB::table('jadwal')
      ->where('id_guru','=',$user)
      ->where('kd_rombel','like',$setting->dari_tahun.'-'.$setting->sampai_tahun."%")
      ->groupBy('kd_rombel')
      ->get();

    $mengajar=DB::table('mengajar')->where('id_guru','=',$user)->get();

    return View::make('hal_guru.n_harian')
      ->with('jadwal',$jadwal);
  }

  public function input_nilai_harian($id){
    $setting=Setting::first();

    $ceksiswa=DB::table('rombel')
      ->where('kd_rombel','=',$id);

    if($ceksiswa->count()>0){
      $siswa=DB::table('siswa_rombel')
        ->where('kd_rombel','=',$id)
        ->join('siswa','siswa_rombel.nis','=','siswa.nis')
        ->get();

      $kelas=Rombel::find($id);

      $mengajar=DB::table('mengajar')
        ->where('id_guru','=',Sentry::getUser()->username)
        ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
        ->first();

      return View::make('hal_guru.input_nilai_harian')
        ->with('mengajar',$mengajar)
        ->with('siswa',$siswa)
        ->with('kelas',$kelas)
        ->with('setting',$setting);
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data Rombel belum ada, hubungi administrator untuk setting Rombel</div>");
      return Redirect::back();
    }
  }

  public function lihat_nilai_harian($id){
    $ceksiswa=DB::table('rombel')
      ->where('kd_rombel','=',$id)->count();

    if($ceksiswa>0){
      $siswa=DB::table('siswa_rombel')
      ->where('kd_rombel','=',$id)
      ->join('siswa','siswa_rombel.nis','=','siswa.nis')
      ->get();
      $kelas=Rombel::find($id);

      $setting=Setting::first();

      $mengajar=DB::table('mengajar')
        ->where('id_guru','=',Sentry::getUser()->username)
        ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
        ->first();

      
      if($setting->semester==1){
        $semester='Ganjil';
      }else{
        $semester='Genap';
      }

      return View::make('hal_guru.lihat_nilai_harian')
      ->with('mengajar',$mengajar)
      ->with('siswa',$siswa)
      ->with('kelas',$kelas)
      ->with('semester',$semester);
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data Rombel belum ada, hubungi administrator untuk setting Rombel</div>");
      return Redirect::back();
    }

  }

  public function simpan_harian(){
    $rombel=Input::get('rombel');
    $setting=Setting::first();

    $mengajar=DB::table('mengajar')
      ->where('id_guru','=',Sentry::getUser()->username)
      ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
      ->first();

    $cek=DB::table('nilai_harian')
      ->where('kd_rombel',$rombel)
      ->where('semester',$setting->semester)
      ->where('kd_mapel',$mengajar->kd_mapel)
      ->max('no_urut');
      if($cek==NULL){
        $nomer=1;
      }else{
        $nomer=$cek+1;
      }

    $no=0;

    $siswa=DB::table('siswa_rombel')->where('kd_rombel','=',$rombel)->get();
    foreach($siswa as $row){
      $no++;
      $data=array(
        'kd_rombel'=>$rombel,
        'nis'=>Input::get('nis'.$no),
        'kd_mapel'=>$mengajar->kd_mapel,
        'semester'=>$setting->semester,
        'nilai'=>Input::get('nilai'.$no),
        'no_urut'=>$nomer
      );
      DB::table('nilai_harian')->insert($data);
    }
    Session::flash('pesan',"<div class='alert alert-info'>
    Data Berhasil disimpan</div>");
    return Redirect::back();
  }

  public function get_nomer(){
    if(Request::ajax()){
      $jenis=Input::get('jenis');
      $mengajar=Input::get('mengajar');
      $semester=Input::get('semester');

      $cek=DB::table('nilai_harian')
      ->where('kd_jenis',$jenis)
      ->where('id_mengajar',$mengajar)
      ->where('semester',$semester)
      ->max('no_urut');
      if($cek==NULL){
        $nomer=1;
      }else{
        $nomer=$cek+1;
      }

      return $nomer;
    }
  }

  public function history_nilai_harian($id){
    $setting=Setting::first();

    $mengajar=DB::table('mengajar')
      ->where('id_guru','=',Sentry::getUser()->username)
      ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
      ->first();

    $nilai=DB::table('nilai_harian')
      ->where('kd_rombel','=',$id)
      ->where('semester','=',$setting->semester)
      ->where('kd_mapel','=',$mengajar->kd_mapel)
      ->groupBy('no_urut')
      ->get();

    return View::make('hal_guru.history_harian')
      ->with('nilai',$nilai)
      ->with('mengajar',$mengajar);
  }

  public function edit_nilai_harian($rombel,$semester,$mapel,$urut){
    $nilai=DB::table('nilai_harian')
      ->where('kd_rombel','=',$rombel)
      ->where('semester','=',$semester)
      ->where('kd_mapel','=',$mapel)
      ->where('no_urut','=',$urut)
      ->join('siswa','siswa.nis','=','nilai_harian.nis')
      ->get();

    $kelas=Rombel::find($rombel);

    $setting=Setting::first();

    $ngajar=DB::table('mengajar')
      ->where('id_guru','=',Sentry::getUser()->username)
      ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
      ->first();

    return View::make('hal_guru.edit_nilai_harian')
      ->with('nilai',$nilai)
      ->with('mengajar',$ngajar)
      ->with('kelas',$kelas);

  }

  public function update_harian(){
    $rombel=Input::get('rombel');
    $nomer=Input::get('nomer');
    $semester=Input::get('semester');
    $no=0;

    $nilai=DB::table('nilai_harian')
      ->where('kd_rombel','=',$rombel)
      ->where('no_urut','=',$nomer)
      ->where('semester','=',$semester)
      ->get();

    foreach($nilai as $row){
      $no++;

      DB::table('nilai_harian')
        ->where('kd_rombel', $rombel)
        ->where('semester',$semester)
        ->where('no_urut',$nomer)
        ->where('nis',Input::get('nis'.$no))
        ->update(array('nilai' => Input::get('nilai'.$no)));
    }

    Session::flash('pesan',"<div class='alert alert-info'>
    Nilai berhasil diupdate</div>");
    return Redirect::back();
  }

  public function n_ujian(){
    $user=Sentry::getUser()->username;
    $setting=Setting::first();

    $jadwal=DB::table('jadwal')
      ->where('id_guru','=',$user)
      ->where('kd_rombel','like',$setting->dari_tahun.'-'.$setting->sampai_tahun."%")
      ->groupBy('kd_rombel')
      ->get();

    $mengajar=DB::table('mengajar')->where('id_guru','=',$user)->get();


    return View::make('hal_guru.n_ujian')
    ->with('jadwal',$jadwal);
  }

  public function input_nilai_uts($id){
    $setting=DB::table('setting')->first();

    $mengajar=DB::table('mengajar')->where('id_guru','=',Sentry::getUser()->username)
      ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
      ->first();

    $cekrombel=DB::table('rombel')->where('kd_rombel',$id)->count();
    if($cekrombel>0){

      $cek=DB::table('nilai_ujian')->where('kd_rombel','=',$id)
        ->where('kd_mapel','=',$mengajar->kd_mapel)
        ->where('semester','=',$setting->semester)
        ->count();

      if($cek>0){
        $siswa=DB::table('nilai_ujian')
        ->where('kd_rombel','=',$id)
        ->where('kd_mapel','=',$mengajar->kd_mapel)
        ->join('siswa','nilai_ujian.nis','=','siswa.nis')
        ->get();

      }else{
        $siswa=DB::table('siswa_rombel')
        ->where('kd_rombel','=',$id)
        ->join('siswa','siswa_rombel.nis','=','siswa.nis')
        ->get();
      }
      $kelas=Rombel::find($id);


      return View::make('hal_guru.input_nilai_uts')
      ->with('mengajar',$mengajar)
      ->with('siswa',$siswa)
      ->with('kelas',$kelas);
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data Rombel belum ada, hubungi administrator untuk setting Rombel</div>");
      return Redirect::back();
    }

  }

  public function simpan_uts(){
    $rombel=Input::get('rombel');
    $nomer=Input::get('nomer');
    $setting=Setting::first();

    $mengajar=DB::table('mengajar')
      ->where('id_guru','=',Sentry::getUser()->username)
      ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
      ->first();

    $no=0;

    $cek=DB::table('nilai_ujian')->where('kd_rombel','=',$rombel)
      ->where('kd_mapel','=',$mengajar->kd_mapel)
      ->where('semester','=',$setting->semester)
      ->count();

    if($cek>0){
      $siswa=DB::table('siswa_rombel')->where('kd_rombel','=',$rombel)->get();
      foreach($siswa as $row){
        $no++;
        DB::table('nilai_ujian')
        ->where('kd_rombel', $rombel)
        ->where('semester',$setting->semester)
        ->where('nis',Input::get('nis'.$no))
        ->update(array('n_uts' => Input::get('nilai'.$no)));
      }

      Session::flash('pesan',"<div class='alert alert-info'>
      Data Berhasil diupdate</div>");
      return Redirect::back();
    }else{
      $siswa=DB::table('siswa_rombel')->where('kd_rombel','=',$rombel)->get();
      foreach($siswa as $row){
        $no++;
        $data=array(
          'kd_rombel'=>$rombel,
          'nis'=>Input::get('nis'.$no),
          'semester'=>$setting->semester,
          'kd_mapel'=>$mengajar->kd_mapel,
          'n_uts'=>Input::get('nilai'.$no)
        );
        DB::table('nilai_ujian')->insert($data);
      }
      Session::flash('pesan',"<div class='alert alert-info'>
      Data Berhasil disimpan</div>");
      return Redirect::back();
    }
  }

  public function input_nilai_uas($id){
    $setting=DB::table('setting')->first();

    $mengajar=DB::table('mengajar')->where('id_guru','=',Sentry::getUser()->username)
      ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
      ->first();

    $cekrombel=DB::table('rombel')->where('kd_rombel',$id)->count();
    if($cekrombel>0){

      $cek=DB::table('nilai_ujian')->where('kd_rombel','=',$id)
      ->where('kd_mapel','=',$mengajar->kd_mapel)
      ->where('semester','=',$setting->semester)
      ->count();

      if($cek>0){
        $siswa=DB::table('nilai_ujian')
        ->where('kd_rombel','=',$id)
        ->where('kd_mapel','=',$mengajar->kd_mapel)
        ->join('siswa','nilai_ujian.nis','=','siswa.nis')
        ->get();

      }else{
        $siswa=DB::table('siswa_rombel')
        ->where('kd_rombel','=',$id)
        ->join('siswa','siswa_rombel.nis','=','siswa.nis')
        ->get();
      }
      $kelas=Rombel::find($id);

      return View::make('hal_guru.input_nilai_uas')
      ->with('mengajar',$mengajar)
      ->with('siswa',$siswa)
      ->with('kelas',$kelas);
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data Rombel belum ada, hubungi administrator untuk setting Rombel</div>");
      return Redirect::back();
    }

  }

  public function simpan_uas(){
    $rombel=Input::get('rombel');

    $setting=DB::table('setting')->first();

    $mengajar=DB::table('mengajar')->where('id_guru','=',Sentry::getUser()->username)
      ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
      ->first();

    $no=0;

    $cek=DB::table('nilai_ujian')->where('kd_rombel','=',$rombel)
    ->where('kd_mapel','=',$mengajar->kd_mapel)
    ->where('semester','=',$setting->semester)
    ->count();

    if($cek>0){
      $siswa=DB::table('siswa_rombel')->where('kd_rombel','=',$rombel)->get();
      foreach($siswa as $row){
        $no++;
        DB::table('nilai_ujian')
        ->where('kd_rombel', $rombel)
        ->where('kd_mapel','=',$mengajar->kd_mapel)
        ->where('semester',$setting->semester)
        ->where('nis',Input::get('nis'.$no))
        ->update(array('n_uas' => Input::get('nilai'.$no)));
      }

      Session::flash('pesan',"<div class='alert alert-info'>
      Data Berhasil diupdate</div>");
      return Redirect::back();
    }else{
      $siswa=DB::table('siswa_rombel')->where('kd_rombel','=',$rombel)->get();
      foreach($siswa as $row){
        $no++;
        $data=array(
          'kd_rombel'=>$rombel,
          'nis'=>Input::get('nis'.$no),
          'semester'=>$setting->semester,
          'n_uas'=>Input::get('nilai'.$no)
        );
        DB::table('nilai_ujian')->insert($data);
      }
      Session::flash('pesan',"<div class='alert alert-info'>
      Data Berhasil disimpan</div>");
      return Redirect::back();
    }
  }

  public function lap_harian(){
    $setting=Setting::first();
    $guru=Guru::find(Sentry::getUser()->username);

    $rombel=DB::table('jadwal')
      ->where('id_guru','=',$guru->id)
      ->where('kd_rombel','like',$setting->dari_tahun.'-'.$setting->sampai_tahun."%")
      ->groupBy('kd_rombel')
      ->get();


    return View::make('hal_guru.lap_harian')
    ->with('kelas',$rombel);
  }

  public function cari_mapel(){
    if(Request::ajax()){
      $kelas=Input::get('kelas');

      $user=Sentry::getUser()->email;

      $guru=DB::select("select nip from guru where email='$user'");
      foreach($guru as $row){
        $nipguru=$row->nip;
      }

      $mengajar=DB::table('mengajar')
        ->where('nip',$nipguru)
        ->where('kd_rombel',$kelas)
        ->get();
      echo "<option value=''>--Pilih Mapel--</option>";
      foreach($mengajar as $row){
        echo "<option value='$row->kd_mapel'>$row->kd_mapel</option>";
      }
    }
  }

  public function cetak_n_harian(){
    $cekrombel=DB::table('rombel')->where('kd_rombel',Input::get('kelas'))->count();
    if($cekrombel>0){
      $guru=Guru::find(Sentry::getUser()->username);
      $setting=Setting::first();

      $rombel=Rombel::find(Input::get('kelas'));
      $semester=Input::get('semester');


      $siswa=DB::table('siswa_rombel')
        ->where('kd_rombel','=',Input::get('kelas'))
        ->join('siswa','siswa_rombel.nis','=','siswa.nis')
        ->get();
      $kelas=Rombel::find($rombel);

      $mengajar=DB::table('mengajar')
        ->where('id_guru','=',Sentry::getUser()->username)
        ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
        ->first();
      $cekHarian=DB::table('nilai_harian')
      ->where('kd_rombel',Input::get('kelas'))
      ->where('semester',$semester)
      ->where('kd_mapel','=',$mengajar->kd_mapel)
      ->count();
      if($cekHarian>0){

        return View::make('hal_guru.cetak_harian')
        ->with('mengajar',$mengajar)
        ->with('siswa',$siswa)
        ->with('kelas',$kelas)
        ->with('semester',$semester)
        ->with('rombel',$rombel)
        ->with('title','Laporan Nilai Harian');
      }else{
        Session::flash('pesan',"<div class='alert alert-danger'>
        Data tidak ditemukan</div>");
        return Redirect::back();
      }
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data Rombel belum ada, hubungi administrator untuk setting Rombel</div>");
      return Redirect::back();
    }
  }

  public function lap_ujian(){
    $setting=Setting::first();
    $guru=Guru::find(Sentry::getUser()->username);

    $rombel=DB::table('jadwal')
      ->where('id_guru','=',$guru->id)
      ->where('kd_rombel','like',$setting->dari_tahun.'-'.$setting->sampai_tahun."%")
      ->groupBy('kd_rombel')
      ->get();

    return View::make('hal_guru.lap_ujian')
    ->with('kelas',$rombel);
  }

  public function cetak_n_ujian(){
    $cekrombel=DB::table('rombel')->where('kd_rombel',Input::get('kelas'))->count();
    if($cekrombel>0){
      $setting=Setting::first();
      $guru=Guru::find(Sentry::getUser()->username);

      $kelas=Input::get('kelas');
      $semester=Input::get('semester');

      $rombel=Rombel::find($kelas);

      $mengajar=DB::table('mengajar')
        ->where('id_guru','=',Sentry::getUser()->username)
        ->where('thn_ajaran','=',$setting->dari_tahun.'-'.$setting->sampai_tahun)
        ->first();

      $cari=DB::table('nilai_ujian')
        ->where('kd_rombel','=',$kelas)
        ->where('semester','=',$semester)
        ->where('kd_mapel','=',$mengajar->kd_mapel)
        ->join('siswa','nilai_ujian.nis','=','siswa.nis');


      if($cari->count()>0){

        return View::make('hal_guru.cetak_ujian')
          ->with('title','Laporan Nilai Ujian')
          ->with('semester',$semester)
          ->with('guru',$guru)
          ->with('rombel',$rombel)
          ->with('mengajar',$mengajar)
          ->with('cari',$cari);
      }else{
        Session::flash('pesan',"<div class='alert alert-danger'>
        Data tidak ditemukan</div>");
        return Redirect::back();
      }
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data Rombel belum ada, hubungi administrator untuk setting Rombel</div>");
      return Redirect::back();
    }
  }

  public function profile(){

    $profile=Guru::find(Sentry::getUser()->username);

    return View::make('hal_guru.profile')
      ->with('profile',$profile);
  }

  public function update_profile(){
    $guru=Guru::find(Sentry::getUser()->username);
    $guru->nuptk=Input::get('nuptk');
    $guru->nm_guru=Input::get('nama');
    $guru->tmp_lahir=Input::get('tempat');
    $guru->tgl_lahir=Input::get('tanggal');
    $guru->pend_terakhir=Input::get('pend');

    if(Input::hasFile('foto')){
      $file=Input::file('foto');
      $filename=str_random(5).'-'.$file->getClientOriginalName();
      $destinationPath='uploads/guru/';
      $file->move($destinationPath,$filename);


      if($guru->foto){
        $fotolama=$guru->foto;
        $filepath=public_path().DIRECTORY_SEPARATOR.'uploads/guru'.DIRECTORY_SEPARATOR.$guru->foto;

        try{
          File::delete($filepath);
        }catch(FileNotFoundException $e){

        }
      }

      $guru->foto=$filename;
    }

    $guru->save();
    Session::flash('pesan',"<div class='alert alert-success'>
    Data Berhasil diupdate</div>");
    return Redirect::back();
  }

  public function password(){
    return View::make('hal_guru.password');
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
        $email=Sentry::getUser()->username;
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
