@extends('template.index')

@section('content')
  <legend>Data Banner</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

  {{Form::open(array('url'=>'admin/banner','method'=>'post','class'=>'form-horizontal','files'=>true))}}
    <div class="form-group">
      <div class="col-sm-4">
        <input type="file" multiple="multiple" name="file[]" class="form-control">
      </div>
      <div class="col-sm-4">

        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-upload"></i>
          Upload</button>
      </div>
    </div>
  {{Form::close()}}

  <div class="row">
    @foreach($banner as $row)
      <div class='col-sm-2' style="margin-right:10px;">
        <div class="thumbnail">
          {{HTML::image('uploads/banner/'.$row->foto,'',array('style'=>'width:100px;'))}}
          <div class="caption">
            <center>
              {{Form::open(array('url'=>'admin/banner/'.$row->id_banner))}}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('hapus',array('class'=>'btn btn-danger'))}}
              {{Form::close()}}
            </center>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@stop
