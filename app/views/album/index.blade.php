@extends('template.index')

@section('content')
  <legend>Gallery</legend>
  <a href="{{URL::to('admin/gallery/create')}}" class="btn btn-primary">
    <i class="glyphicon glyphicon-plus"></i>
    Tambah Gallery
  </a>

  @if(Session::has('pesan'))
    <hr>
    {{Session::get('pesan')}}
  @endif

  <table class="table table-striped" id="contoh">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Album</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($album as $row)
        <?php $no++;?>
        <tr>
          <td>{{$no}}</td>
          <td>{{$row->nm_album}}</td>
          <td>
            <a href="{{URL::to('admin/gallery/'.$row->id_album.'/tambahfoto')}}" class="btn btn-success">
              <i class="glyphicon glyphicon-film"></i>
            </a>
          </td>
          <td>
            <a href="{{URL::to('admin/gallery/'.$row->id_album.'/edit')}}" class="btn btn-warning">
              <i class="glyphicon glyphicon-edit"></i>
            </a>
          </td>
          <td>
            {{Form::open(array('url'=>'admin/gallery/'.$row->id_album))}}
              {{Form::hidden('_method','DELETE')}}
              {{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
            {{Form::close()}}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
