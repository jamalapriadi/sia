@extends('template.index')

@section('content')
  <legend>Edit Nilai Harian</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

  {{Form::open(array('url'=>'guru/update_nilai_harian','method'=>'POST'))}}
  <table class="table table-bordered">
    <tr>
      <td>Kelas</td>
      <td> : {{$kelas->kd_kelas}}</td>
    </tr>
    <tr>
      <td>Tahun Ajaran</td>
      <td> : {{$kelas->thn_ajaran}}</td>
    </tr>
  </table>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>NIS</th>
        <th>Nama</th>
        <th></th>
      </tr>
    </thead>
    <?php $no=0;?>
    @foreach($nilai as $row)
      <?php $no++;?>
      <tr>
        <td>{{$no}}</td>
        <td>{{$row->nis}}</td>
        <td>{{$row->nm_siswa}}</td>
        <td>
          <input type="hidden" name="rombel" value="{{$row->kd_rombel}}">
          <input type="hidden" name="semester" value="{{$row->semester}}">
          <input type="hidden" name="nomer" value="{{$row->no_urut}}">
          <input type="hidden" name="nis{{$no}}" value="{{$row->nis}}">
          <input type="number" min='1' max='10' style="width:20%" required="required" name="nilai{{$no}}" value="{{$row->nilai}}" class="form-control">
        </td>
      </tr>
    @endforeach
  </table>

  <div class="well">
    <button class="btn btn-primary">
      Update Nilai
    </button>
  </div>
  {{Form::close()}}
@stop
