@extends('template.index')

@section('content')
  <legend>Tambah Gallery</legend>
  {{Form::open(array('url'=>'admin/gallery','method'=>'post','class'=>'form-horizontal','files'=>true))}}
    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->text('nama','Nama Gallery','',$errors)}}

    <div class="form-group well">
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-saved"></i>
          Update
        </button>
      </div>
    </div>
  {{Form::close()}}
@stop
