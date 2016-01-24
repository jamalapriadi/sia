@extends('template.laporan')

@section('content')
  <br><br>
  <div class="col-md-6">
    <table width="100%">
      <tr>
        <td>NIS</td>
        <td> : {{$siswa->nis}}</td>
      </tr>
      <tr>
        <td>Siswa</td>
        <td> : {{$siswa->nm_siswa}}</td>
      </tr>
      <tr>
        <td>Semester</td>
        <td> : {{$semester}}</td>
      </tr>
    </table>
  </div>

  <div class="col-md-6">
    <table width="100%">
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

  <br><br>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>
          No.
        </th>
        <th>
          Mapel
        </th>
        <th colspan="10">
          Nilai
        </th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($nilai as $row)
        <?php $no++;?>
        <tr>
          <td>
            {{$no}}
          </td>
          <td>
            {{$row->kd_mapel}}
          </td>
          <?php
            $getnilai=DB::table('nilai_harian')
              ->where('kd_mapel',$row->kd_mapel)
              ->where('kd_rombel',$kelas->kd_rombel)
              ->where('semester',$semester)
              ->where('nis',Sentry::getUser()->username)
              ->get();
          ?>
          @foreach($getnilai as $get)
            <td>{{$get->nilai}}</td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>


@stop
