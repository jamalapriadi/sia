@extends('template.index')

@section('content')
<legend>Upload Materi</legend>
@if(Session::has('pesan'))
  {{Session::get('pesan')}}
@endif

{{Form::model($materi,array('url'=>route('guru.materi.update',['materi'=>$materi->id_materi]),
'method'=>'PUT','class'=>'form-horizontal','files'=>true))}}
{{Bootstrap::horizontal('col-sm-4','col-sm-2')
->text('judul','Judul Materi',$materi->judul_materi,$errors)}}

<div class="form-group">
  {{Form::label('file','File Materi',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <a href="{{URL::to('uploads/materi/'.$materi->file)}}">
      {{$materi->file}}
    </a>
  </div>
</div>
<div class="form-group">
  {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <input type="file" name="file" class="form-control">
  </div>
</div>

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
