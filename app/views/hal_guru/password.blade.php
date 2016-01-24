@extends('template.index')

@section('content')
  <legend>Ganti Password</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

  {{Form::open(array('url'=>'guru/update_password','method'=>'POST','class'=>'form-horizontal'))}}
    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->password('lama','Password Lama',$errors)}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->password('password','Password Baru',$errors)}}

    {{Bootstrap::horizontal('col-sm-4','col-sm-2')
      ->password('password_confirmation','Konfirmasi Password',$errors)}}

    <div class="form-group well">
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-edit"></i>
          Update Password
        </button>
      </div>
    </div>
  {{Form::close()}}
@stop
