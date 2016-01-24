@extends('template.index')

@section('content')
  <legend>Edit Ekstrakurikuler : {{$ekstra->nm_ekstra}}</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

{{Form::model($ekstra,array('url'=>route('admin.ekstrakurikuler.update',['ekstrakurikuler'=>$ekstra->id_ekstra]),'method'=>'PUT','class'=>'form-horizontal','files'=>true))}}
  {{Bootstrap::horizontal('col-sm-4','col-sm-2')
  ->text('nama','Nama Ekstra',$ekstra->nm_ekstra,$errors)}}

  {{Bootstrap::horizontal('col-sm-4','col-sm-2')
  ->text('nip','NIP Pengampu',$ekstra->nip,$errors)}}

  {{Bootstrap::horizontal('col-sm-8','col-sm-2')
  ->textarea('keterangan','Keterangan',$ekstra->keterangan)}}

  <div class="form-group">
    {{Form::label('Logo','Logo',array('class'=>'col-sm-2 control-label'))}}
    <div class="col-sm-4">
      {{HTML::image('uploads/ekstra/'.$ekstra->logo_ekstra,'',array('style'=>'width:100px;'))}}
    </div>
  </div>

  <div class="form-group">
    {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
    <div class="col-sm-4">
      <input type="file" name="logo" class="form-control">
    </div>
  </div>

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
