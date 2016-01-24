@extends('template.index')

@section('content')
  <legend>Jenis Nilai</legend>
  <a href="{{URL::to('admin/jenis/create')}}" class="btn btn-primary">
    <i class="glyphicon glyphicon-plus"></i>
    Tambah Data
  </a>

  @if(Session::has('pesan'))
    <hr>
    {{Session::get('pesan')}}
  @endif

  <table class="table table-striped" id="contoh">
    <thead>
      <tr>
        <th>No.</th>
        <th>Kode Jenis</th>
        <th>Nama Jenis</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($jenis as $row)
        <?php $no++;?>
        <tr>
          <td>{{$no}}</td>
          <td>{{$row->kd_jenis}}</td>
          <td>{{$row->nm_jenis}}</td>
          <td>
            <a href="{{URL::to('admin/jenis/'.$row->kd_jenis.'/edit')}}" class="btn btn-success">
              Edit
            </a>
          </td>
          <td>
            {{Form::open(array('url'=>'admin/jenis/'.$row->kd_jenis))}}
              {{Form::hidden('_method','DELETE')}}
              {{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
            {{Form::close()}}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
