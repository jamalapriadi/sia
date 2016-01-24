@extends('template.index')

@section('content')
  <legend>Tambah Data Ekstra</legend>
  {{Form::open(array('url'=>'admin/ekstrakurikuler','method'=>'POST','class'=>'form-horizontal','files'=>true))}}
    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->text('nama','Nama Ekstra','',$errors)}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->text('nip','NIP Pengampu','',$errors)}}

    {{Bootstrap::horizontal('col-sm-8','col-sm-2')
      ->textarea('keterangan','Keterangan')}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->file('logo','Logo Ekstra')}}

    <div class="form-group well">
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-saved"></i>
          Simpan
        </button>
        <a href="{{URL::to('admin/ekstrakurikuler')}}" class="btn btn-default">
          Kembali
        </a>
      </div>
    </div>
  {{Form::close()}}
@stop
