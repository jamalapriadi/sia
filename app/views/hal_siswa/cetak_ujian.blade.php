@extends('template.laporan')

@section('content')
<br><br>
<div class="row" style="margin-bottom:20px;">
  <div class="col-md-6">
    <table style="width:100%">
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

  <div class="col-md-6">
    <table style="width:100%">
      <tr>
        <td>Kelas</td>
        <td> : {{$kelas->kd_kelas}}</td>
      </tr>
      <tr>
        <td>Tahun Ajaran</td>
        <td> : {{$kelas->thn_ajaran}}</td>
      </tr>
      <tr>
        <td>Wali Kelas</td>
        <td> : {{$kelas->guru->nm_guru}}</td>
      </tr>
    </table>
  </div>
</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th rowspan='3' style="width:5%">No.</th>
      <th rowspan='3'>Mapel</th>
      <th colspan='15'>Jenis Nilai</th>
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
      <td>{{$row->kd_mapel}}</td>
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
        ?>
        {{$nh}}
      </td>
      <td>{{$row->n_uts}}</td>
      <td>{{$row->n_uas}}</td>
      <td>{{number_format((25/100 * $nh) + (35/100*$row->n_uts) + (40/100 * $row->n_uas),2)}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop
