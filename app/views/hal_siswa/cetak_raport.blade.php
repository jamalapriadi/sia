@extends('template.laporan')

@section('content')
<div class="row">
  <div class="col-sm-6">
    <table class="table">
      <tr>
        <td>NIS</td>
        <td> : {{$nis->nis}}</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td> : {{$nis->nm_siswa}}</td>
      </tr>
      <tr>
        <td>Semester</td>
        <td> : {{$semester}}</td>
      </tr>
    </table>
  </div>

  <div class="col-sm-6">
    <table class="table">
      <tr>
        <td>Kelas</td>
        <td> : {{$kelas->kd_kelas}}</td>
      </tr>
      <tr>
        <td>Tahun Ajaran</td>
        <td> : {{$kelas->thn_ajaran}}</td>
      </tr>
      <tr>
        <td>
          Wali Kelas
        </td>
        <td>
           : {{$kelas->guru->nm_guru}}
        </td>
      </tr>
    </table>
  </div>

</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th rowspan='2'>No.</th>
      <th rowspan='2'>Mata Pelajaran</th>
      <th rowspan='2'>KKM</th>
      <th colspan='2'>Nilai</th>
      <th rowspan='2'>Deskripsi Kemajuan Belajar</th>
    </tr>
    <tr>
      <th>Angka</th>
      <th>Huruf</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=0;?>
    @foreach($nilai as $row)
    <?php $no++;?>
    <tr>
      <td>{{$no}}</td>
      <td>{{$row->kd_mapel}}</td>
      <td>
        <?php
        //tampilkan nilai kkm sesuai dengan tahun ajaran ini
        $kkm=DB::table('kkm')->where('thn_ajaran',$kelas->thn_ajaran)
          ->where('kd_mapel',$row->kd_mapel)->first();
        $nkkm=isset($kkm->nilai_kkm)?$kkm->nilai_kkm:0;
        ?>
        {{$nkkm}}
      </td>
      <td>
        <?php
          //cari jumlah uh di kelas ini
          $nilai=DB::table('nilai_harian')
            ->where('kd_rombel','=',$kelas->kd_rombel)
            ->where('semester','=',$semester)
            ->where('kd_mapel','=',$row->kd_mapel)
            ->where('nis','=',$row->nis);
          $jumlah=$nilai->count();
          $max=$nilai->sum('nilai');
          $nh=$max/$jumlah;
          $na=ceil((25/100 * $nh) + (35/100*$row->n_uts) + (40/100 * $row->n_uas));
        ?>
        {{ceil((25/100 * $nh) + (35/100*$row->n_uts) + (40/100 * $row->n_uas))}}
      </td>
      <td>{{Tanggal::terbilang($na)}}</td>
      @if($na<$nkkm)
        <td class="danger">
          KKM tidak terlampaui
        </td>
      @elseif($na==$nkkm)
        <td class="info">
          KKM Terlampaui / Tuntas
        </td>
      @else($na>$nkkm)
        <td class="success">
          KKM Terlampaui
        </td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
@stop
