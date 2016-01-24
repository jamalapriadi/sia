@extends('template.laporan')

@section('content')
<table>
  <tr>
    <td>Rombel</td>
    <td> : {{$rombel->kd_rombel}}</td>
  </tr>
  <tr>
    <td>Semester</td>
    <td> : {{$semester}}</td>
  </tr>
  <tr>
    <td>Mata Pelajaran</td>
    <td> : {{$mengajar->kd_mapel}}</td>
  </tr>
  <tr>
    <td>NIP /  Nama Wali</td>
    <td> : {{$rombel->guru->nm_guru}}</td>
  </tr>
</table>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th rowspan='2'>No.</th>
      <th rowspan='2'>NIS</th>
      <th rowspan='2'>Nama Siswa</th>
      <th colspan='4'>Nilai</th>
    </tr>
    <tr>
      <th>NH</th>
      <th>UTS</th>
      <th>UAS</th>
      <th>NA</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=0;?>
    @foreach($cari->get() as $row)
      <?php $no++;?>
      <tr>
        <td>{{$no}}</td>
        <td>{{$row->nis}}</td>
        <td>{{$row->nm_siswa}}</td>
        <td>
          <?php
            //cari jumlah uh di kelas ini
            $nilai=DB::table('nilai_harian')
              ->where('kd_rombel','=',$rombel->kd_rombel)
              ->where('semester','=',$semester)
              ->where('kd_mapel','=',$mengajar->kd_mapel)
              ->where('nis','=',$row->nis);
            $jumlah=$nilai->count();
            $max=$nilai->sum('nilai');
            $nh=$max/$jumlah;
          ?>
          {{$nh}}
        </td>
        <td>{{$row->n_uts}}</td>
        <td>{{$row->n_uas}}</td>
        <td>{{number_format((25/100 * $nh) + (35/100*$row->n_uts) + (40/100 * $row->n_uas),2)}}</td>
    @endforeach
  </tbody>
  </tbody>
  @stop
