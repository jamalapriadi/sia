@extends('template.index')

@section('content')
  <legend>Data Ekstrakurikuler</legend>
  <a href="{{URL::to('admin/ekstrakurikuler/create')}}" class="btn btn-primary">
    <i class="glyphicon glyphicon-plus"></i>
    Tambah Ekstra
  </a>

  @if(Session::has('pesan'))
    <hr>
    {{Session::get('pesan')}}
  @endif

  <table class="table table-striped" id="contoh">
    <thead>
      <tr>
        <th>No</th>
        <th>Logo</th>
        <th>Nama Ekstra</th>
        <th>Pengampu</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($ekstra as $row)
        <?php $no++;?>
        <tr>
          <td>{{$no}}</td>
          <td>{{HTML::image('uploads/ekstra/'.$row->logo_ekstra,'',array('style'=>'width:100px;'))}}</td>
          <td>{{$row->nm_ekstra}}</td>
          <td>{{$row->nip}}</td>
          <td>
            <a class="btn btn-default" href="{{URL::to('admin/ekstrakurikuler/'.$row->id_ekstra)}}">
              <i class="glyphicon glyphicon-list-alt"></i>
            </a>
          </td>
          <td>
            <a class="btn btn-success" href="{{URL::to('admin/ekstrakurikuler/'.$row->id_ekstra.'/edit')}}">
              <i class="glyphicon glyphicon-edit"></i>
            </a>
          </td>
          <td>
            {{Form::open(array('url'=>'admin/ekstrakurikuler/'.$row->id_ekstra))}}
              {{Form::hidden('_method','DELETE')}}
              {{Form::submit('hapus',array('class'=>'btn btn-danger'))}}
            {{Form::close()}}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
