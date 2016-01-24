@extends('template.index')

@section('content')
  <legend>Tambah Admin</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif
  
  {{Form::open(array('url'=>'admin/user','method'=>'post','class'=>'form-horizontal'))}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->text('username','Username','',$errors)}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->email('email','Email','',$errors)}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->password('password','Passoword')}}

    <div class="form-group well">
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class='col-sm-4'>
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-saved"></i>
          Simpan
        </button>
        <a href="{{URL::to('admin/user')}}" class="btn btn-default">
          Kembali
        </a>
      </div>
    </div>
  {{Form::close()}}
@stop
