@extends('template.index')

@section('content')
  <legend>Data Materi</legend>

  <a href="{{URL::to('guru/materi/create')}}" class="btn btn-primary">
    <i class="glyphicon glyphicon-upload"></i>
    Upload Materi
  </a>

  @if(Session::has('pesan'))
    <hr>
    {{Session::get('pesan')}}
  @endif

  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Judul</th>
        <th>File</th>
        <th colspan='2'></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($materi as $row)
      <?php $no++;?>
      <tr>
        <td>{{$no}}</td>
        <td>{{$row->judul_materi}}</td>
        <td>
          <a href="{{URL::to('uploads/materi/'.$row->file)}}" target="new target">
            {{$row->file}}
          </a>
        </td>
        <td>
          <a class="btn btn-success" href="{{URL::to('guru/materi/'.$row->id_materi.'/edit')}}">
            <i class="glyphicon glyphicon-edit"></i>
          </a>
        </td>
        <td>
          {{Form::open(array('url'=>'guru/materi/'.$row->id_materi))}}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
          {{Form::close()}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
