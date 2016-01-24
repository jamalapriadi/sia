<?php
class LapController extends BaseController{
  public function rombel(){
    $kelas=Kelas::all();
    return View::make('laporan.rombel')
      ->with('kelas',$kelas);
  }

  public function get_tahun(){
    if(Request::ajax()){
      $kelas=Input::get('kelas');

      $rombel=DB::table('rombel')->where('kd_kelas',$kelas)->get();

      echo "<option value=''>--Pilih Tahun Ajaran--</option>";
      foreach($rombel as $r){
        echo "<option value='$r->thn_ajaran'>$r->thn_ajaran</option>";
      }
    }
  }

  public function cetak_rombel(){
    $kode=Input::get('tahun').'-'.Input::get('kelas');

    $rombel=Rombel::find($kode);

    $siswa=DB::table('siswa_rombel')->where('kd_rombel',$kode)
      ->join('siswa','siswa.nis','=','siswa_rombel.nis')
      ->get();

    return View::make('laporan.cetak_rombel')
      ->with('rombel',$rombel)
      ->with('siswa',$siswa)
      ->with('title','Laporan Data Rombel');
  }

  public function mengajar(){
    $guru=Guru::all();
    $rombel=DB::table('rombel')->groupBy('thn_ajaran')->get();

    return View::make('laporan.mengajar')
      ->with('guru',$guru)
      ->with('rombel',$rombel);
  }

  public function cetak_mengajar(){
    $nip=Input::get('nip');
    $tahun=Input::get('tahun');

    if(empty($nip)){
      $mengajar=DB::table('mengajar')
      ->where('thn_ajaran','=',$tahun)
      ->join('guru','guru.id','=','mengajar.id_guru')
      ->get();
    }else{
      $mengajar=DB::table('mengajar')
        ->where('id_guru','=',$nip)
        ->where('thn_ajaran','=',$tahun)
        ->join('guru','guru.id','=','mengajar.id_guru')
        ->get();
    }

    return View::make('laporan.cetak_mengajar')
      ->withTitle('Laporan Data Mengajar')
      ->with('mengajar',$mengajar);
  }

  public function jadwal(){
    $rombel=DB::table('rombel')->groupBy('thn_ajaran')->get();
    return View::make('laporan.jadwal')
      ->with('rombel',$rombel);
  }

  public function cetak_jadwal(){
    $tahun=Input::get('tahun');
    $t=DB::table('kelas')->where('kelas','7')->count();
    $d=DB::table('kelas')->where('kelas','8')->count();
    $s=DB::table('kelas')->where('kelas','9')->count();

    $jam=Jam::all();

    return View::make('laporan.cetak_jadwal')
      ->withTitle('Laporan Jadwal Pelajaran')
      ->with('t',$t)
      ->with('d',$d)
      ->with('s',$s)
      ->with('jam',$jam)
      ->with('tahun',$tahun);
  }

  public function n_harian(){
    $kelas=Kelas::all();
    $tahun=DB::table('rombel')->groupBy('thn_ajaran')->get();
    $mapel=Mapel::all();
    $guru=Guru::all();
    return View::make('laporan.harian')
      ->with('kelas',$kelas)
      ->with('tahun',$tahun)
      ->with('mapel',$mapel)
      ->with('guru',$guru);
  }

  public function cetak_harian(){

    $kelas=Input::get('kelas');
    $tahun=Input::get('tahun');
    $mapel=Input::get('mapel');
    $semester=Input::get('semester');


    $siswa=DB::table('siswa_rombel')
    ->where('kd_rombel','=',$tahun.'-'.$kelas)
    ->join('siswa','siswa_rombel.nis','=','siswa.nis')
    ->get();

    $kode=$tahun.'-'.$kelas;

    $rombel=Rombel::find($tahun.'-'.$kelas);

    $setting=Setting::first();


    $cekHarian=DB::table('nilai_harian')
      ->where('kd_rombel',$kode)
      ->where('kd_mapel',$mapel)
      ->where('semester',$semester)
      ->count();
    if($cekHarian>0){
      return View::make('laporan.cetak_harian')
      ->with('siswa',$siswa)
      ->with('rombel',$rombel)
      ->with('mapel',$mapel)
      ->with('semester',$semester)
      ->with('title','Laporan Nilai Harian');
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data tidak ditemukan</div>");
      return Redirect::back();
    }
  }

  public function n_ujian(){
    $kelas=Kelas::all();
    $tahun=DB::table('rombel')->groupBy('thn_ajaran')->get();
    $mapel=Mapel::all();

    return View::make('laporan.ujian')
    ->with('kelas',$kelas)
    ->with('tahun',$tahun)
    ->with('mapel',$mapel);
  }

  public function cetak_ujian(){
    $rombel=Input::get('tahun').'-'.Input::get('kelas');
    $kelas=Input::get('kelas');
    $tahun=Input::get('tahun');
    $nip=Input::get('nip');
    $mapel=Input::get('mapel');
    $semester=Input::get('semester');

    $koderombel=Rombel::find($rombel);

    $cari=DB::table('nilai_ujian')
      ->where('kd_rombel','=',$rombel)
      ->where('kd_mapel','=',$mapel)
      ->where('semester','=',$semester)
      ->join('siswa','siswa.nis','=','nilai_ujian.nis');

    $cekNilai=$cari->count();

    if($cekNilai>0){
      $nilai=$cari->get();

      return View::make('laporan.cetak_ujian')
      ->with('title','Laporan Nilai Ujian')
      ->with('nilai',$nilai)
      ->with('kelas',$kelas)
      ->with('tahun',$tahun)
      ->with('mapel',$mapel)
      ->with('semester',$semester)
      ->with('kode',$koderombel);
    }else{
      Session::flash('pesan',"<div class='alert alert-danger'>
      Data tidak ditemukan</div>");
      return Redirect::back();
    }
  }
}
