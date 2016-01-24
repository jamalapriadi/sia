@extends('template.laporan')

@section('content')
  <p>Kelas : {{$rombel->kd_kelas}}</p>
  <p>Wali : {{$rombel->guru->nm_guru}}</p>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>JK</th>
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
          <td>{{$row->jk}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
