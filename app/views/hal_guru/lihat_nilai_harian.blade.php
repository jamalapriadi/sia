@extends('template.index')

@section('content')
<legend>Input Nilai Harian</legend>

<table class="table table-bordered">
  <tr>
    <td>Kelas</td>
    <td> : {{$kelas->kd_kelas}}</tD>
    </tr>
    <tr>
      <td>Tahun Ajaran</td>
      <td> : {{$kelas->thn_ajaran}}</tD>
      </tr>
      <tr>
        <td>NIP / Nama Wali</td>
        <td> : {{$kelas->guru->nm_guru}}</td>
      </tR>
    </table>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align:center;">No.</th>
          <th style="text-align:center;">NIS</th>
          <th style="text-align:center;">Nama</th>
          <!-- jumlah ulangna -->
          <th colspan='10' style="text-align:center;"></th>
        </tr>

      </thead>
      <tbody>
        <?php $no=0;?>
        @foreach($siswa as $row)
        <?php $no++;?>
        <tr>
          <td>{{$no}}</td>
          <td>{{$row->nis}}</td>
          <td>{{$row->nm_siswa}}</td>
          <?php
            $nil=DB::table('nilai_harian')
              ->where('kd_rombel','=',$kelas->kd_rombel)
              ->where('kd_mapel','=',$mengajar->kd_mapel)
              ->where('nis','=',$row->nis)
              ->get();
          ?>
          @foreach($nil as $ni)
            <td>{{$ni->nilai}}</td>
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
    @stop
