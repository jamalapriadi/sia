@extends('template.index')
@section('content')
  <legend>Tambah Jenis Nilai</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif
  {{Form::open(array('url'=>'admin/jenis','method'=>'POST','class'=>'form-horizontal'))}}
    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->text('kode','Kode Jenis','',$errors)}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->text('nama','Nama Jenis Nilai','',$errors)}}

    <div class='form-group well'>
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-saved"></i>
          Simpan
        </button>

        <a href="{{URL::to('admin/jenis')}}" class="btn btn-default">
          Kembali
        </a>
      </div>
    </div>
  {{Form::close()}}
@stop
