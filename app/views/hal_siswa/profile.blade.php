@extends('template.index')

@section('content')
  <legend>Profile # {{$profile->nm_siswa}}</legend>

  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

  {{Form::open(array('url'=>'siswa/update_profile','method'=>'POST','class'=>'form-horizontal','files'=>true))}}
    <div class="row">
      <div class="col-sm-8">
        {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->text('nis','NIS',$profile->nis,$errors,array('readonly'=>'readonly'))}}


          {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->text('nama','Nama Siswa',$profile->nm_siswa,$errors)}}

          {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->text('tempat','Tempat Lahir',$profile->tmp_lahir,$errors)}}

          {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->date('tanggal','Tanggal Lahir',$profile->tgl_lahir,$errors)}}

          {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->text('ayah','Nama Ayah',$profile->nm_ayah,$errors)}}

          {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->text('ibu','Nama Ibu',$profile->nm_ibu,$errors)}}

          {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->text('alamat','Alamat',$profile->alamat,$errors)}}

          {{Bootstrap::horizontal('col-sm-6','col-sm-3')
          ->text('sttb','Tahun STTB',$profile->thn_sttb,$errors)}}
      </div>

      <div class="col-sm-4">
        <center>
          {{HTML::image('uploads/siswa/'.$profile->foto,'',array('style'=>'width:200px;'))}}
        </center><br>
        <input type="file" name="foto" class="form-control">
      </div>
    </div>

    <div class="form-group well">
      {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <button class="btn btn-primary">
          <i class="glyphicon glyphicon-edit"></i>
          Update Profile
        </button>
      </div>
    </div>
  {{Form::close()}}
@stop
