@extends('template.index')

@section('content')
  <legend>Upload Materi</legend>
  {{Form::open(array('url'=>'guru/materi','method'=>'post',
  'class'=>'form-horizontal','files'=>true))}}
    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->text('judul','Judul Materi','',$errors)}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->file('file','Materi')}}

    <div class="form-group well">
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-upload"></i>
          Uploads
        </button>

        <a href="{{URL::to('guru/materi')}}" class="btn btn-default">
          Kembali
        </a>
      </div>
    </div>
  {{Form::close()}}
@stop
