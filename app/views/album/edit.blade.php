@extends('template.index')

@section('content')
<legend>Tambah Gallery</legend>
@if(Session::has('pesan'))
  {{Session::get('pesan')}}
@endif
{{Form::model($album,array('url'=>route('admin.gallery.update',['album'=>$album->id_album]),'method'=>'PUT','class'=>'form-horizontal','files'=>true))}}
{{Bootstrap::horizontal('col-sm-4','col-sm-2')
->text('nama','Nama Gallery',$album->nm_album,$errors)}}

<div class="form-group well">
  {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <button class="btn btn-primary">
      <i class="glyphicon glyphicon-saved"></i>
      Update
    </button>

    <a href="{{URL::to('admin/gallery')}}" class="btn btn-default">
      Kembali
    </a>
  </div>
</div>
{{Form::close()}}
@stop
