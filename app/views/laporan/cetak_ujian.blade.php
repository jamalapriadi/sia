@extends('template.laporan')

@section('content')
  <table>
    <tr>
      <td>Kelas</td>
      <td> : {{$kelas}}</td>
    </tr>
    <tr>
      <td>Tahun Ajaran</td>
      <td> : {{$tahun}}</td>
    </tr>
    <tr>
      <td>Semester</td>
      <td> : {{$semester}}</td>
    </tr>
    <tr>
      <td>Mata Pelajaran</td>
      <td> : {{$mapel}}</td>
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
      @foreach($nilai as $row)
        <?php $no++;?>
        <tr>
          <td>{{$no}}</td>
          <td>{{$row->nis}}</td>
          <td>{{$row->nm_siswa}}</td>
          <?php
            $harian=DB::table('nilai_harian')
              ->where('kd_rombel','=',$kode->kd_rombel)
              ->where('kd_mapel','=',$mapel)
              ->where('nis',$row->nis);
            $jumHarian=$harian->count();
            $getHarian=$harian->get();
            $hasil=0;
            foreach($getHarian as $har){
              $nilai=$har->nilai;
              $hasil=$hasil+$nilai;
            }
            $hasil=$hasil/$jumHarian;
          ?>
          <td>{{number_format($hasil,1)}}</td>
          <td>{{$row->n_uts}}</td>
          <td>{{$row->n_uas}}</td>
          <td>{{number_format((25/100 * $hasil) + (35/100*$row->n_uts) + (40/100 * $row->n_uas),1)}}</td>
        </tr>
      @endforeach
    </tbody>
  </tbody>
@stop
