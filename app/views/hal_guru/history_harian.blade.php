@extends('template.index')

@section('content')
  <legend>History Nilai Harian</legend>
  <table class='table table-striped'>
    <thead>
      <tr>
        <th>No.</th>
        <th>Rombel</th>
        <th>Semester</th>
        <th>
          Nilai Ke -
        </th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($nilai as $row)
      <?php $no++;?>
      <tr>
        <td>{{$no}}</td>
        <td>{{$row->kd_rombel}}</td>
        <td>{{$row->semester}}</td>
        <td>{{$row->no_urut}}</td>
        <td>
          <a href="{{URL::to('guru/'.$row->kd_rombel.'/'.
            $row->semester.'/'.$mengajar->kd_mapel.'/'.$row->no_urut.'/edit_nilai_harian')}}" class="btn btn-success">
            Edit Nilai
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
