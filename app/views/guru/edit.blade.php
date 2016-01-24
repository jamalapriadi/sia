@extends('template.index')

@section('content')
	<div class="well">
		<legend>Tambah Data Guru</legend>
		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif

		{{Form::model($guru,array('url'=>route('admin.guru.update',['guru'=>$guru->id]),'method'=>'PUT','class'=>'form-horizontal','files'=>true))}}
			<div class="form-group">
				{{Form::label('id','ID Guru',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('id',$guru->id,array('class'=>'form-control','readonly'=>'readonly'))}}
				</div>
				{{$errors->first('nip')}}
			</div>

			<div class="form-group">
				{{Form::label('nip','NIP',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nip',$guru->nip,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nip')}}
			</div>

			<div class="form-group">
				{{Form::label('nuptk','NUPTK',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nuptk',$guru->nuptk,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nuptk')}}
			</div>

			<div class="form-group">
				{{Form::label('email','Email',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::email('email',$guru->email,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('email')}}
			</div>

			<div class="form-group">
				{{Form::label('nama','Nama Guru',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nama',$guru->nm_guru,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nama')}}
			</div>

			<div class="form-group">
				{{Form::label('tempat','Tempat Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tempat',$guru->tmp_lahir,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tempat')}}
			</div>

			<div class="form-group">
				{{Form::label('tanggal','Tanggal Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<input type="text" id="tanggal" value="{{date('d-m-Y',strtotime($guru->tgl_lahir))}}" class="form-control" name="tanggal">
				</div>
				{{$errors->first('tanggal')}}
			</div>

			<div class="form-group">
				{{Form::label('jk','JK',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="jk" class="form-control">
						<option value="{{$guru->jk}}">{{$guru->jk}}</option>
						<option value="L">L</option>
						<option value="P">P</option>
					</select>
				</div>
				{{$errors->first('jk')}}
			</div>

			<div class="form-group">
				{{Form::label('pendidikan','Pendidikan Terakhir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('pendidikan',$guru->pend_terakhir,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('pendidikan')}}
			</div>

			<div class="form-group">
				{{Form::label('tahun','tahun',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tahun',$guru->tahun,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tahun')}}
			</div>

			<div class="form-group">
				{{Form::label('mulai','Mulai Kerja',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<input type="text" id="tanggal2" value="{{date('d-m-Y',strtotime($guru->mulai_kerja))}}" name="mulai" class="form-control">
				</div>
				{{$errors->first('mulai')}}
			</div>

			<div class="form-group">
				{{Form::label('foto','Foto',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<img src="{{URL::to('uploads/guru/'.$guru->foto)}}" style="max-height:200px;">
				</div>
			</div>

			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::file('foto')}}
				</div>
			</div>

			<hr>
			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-saved"></i>
						Update
					</button>

					<a href="{{URL::to('admin/guru')}}" class="btn btn-default">Kembali</a>
				</div>
			</div>

		{{Form::close()}}
	</div>
@stop