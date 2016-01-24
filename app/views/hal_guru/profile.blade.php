@extends('template.index')

@section('content')
  <legend>Profile : {{$profile->nm_guru}}</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif
  
  {{Form::open(array('url'=>'guru/update_profile','method'=>'POST','class'=>'form-horizontal','files'=>true))}}
    <div class="row">
      <div class="col-sm-8">
        {{Bootstrap::horizontal('col-sm-6','col-sm-3')
        ->text('nip','NIP',$profile->nip,$errors,array('readonly'=>'readonly'))}}

        {{Bootstrap::horizontal('col-sm-6','col-sm-3')
        ->text('nama','NUPTK',$profile->nuptk,$errors)}}

        {{Bootstrap::horizontal('col-sm-6','col-sm-3')
        ->text('nama','Nama',$profile->nm_guru,$errors)}}

        {{Bootstrap::horizontal('col-sm-6','col-sm-3')
        ->text('tempat','Tempat Lahir',$profile->tmp_lahir,$errors)}}

        {{Bootstrap::horizontal('col-sm-6','col-sm-3')
        ->date('tanggal','Tanggal Lahir',$profile->tgl_lahir,$errors)}}

        {{Bootstrap::horizontal('col-sm-6','col-sm-3')
        ->text('pend','Pendidikan Terakhir',$profile->pend_terakhir,$errors)}}

      </div>

      <div class="col-sm-4">
        <center>
        {{HTML::image('uploads/guru/'.$profile->foto,'',array('style'=>'width:200px;'))}}
      </center><br>
        <input type="file" name="foto" class="form-control">
      </div>
    </div>

    <div class="form-group well">
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-export"></i>
          Update
        </button>
      </div>
    </div>
  {{Form::close()}}
@stop
