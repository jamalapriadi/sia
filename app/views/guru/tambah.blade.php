@extends('template.index')

@section('content')
	<div class="well">
		<legend>Tambah Data Guru</legend>

		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif

		{{Form::open(array('url'=>'admin/guru','method'=>'POST','class'=>'form-horizontal','files'=>true))}}
			<div class="form-group">
				{{Form::label('id','ID Guru',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('id',Input::old('id'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('id')}}
			</div>

			<div class="form-group">
				{{Form::label('nip','NIP',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nip',Input::old('nip'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nip')}}
			</div>

			<div class="form-group">
				{{Form::label('nuptk','NUPTK',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nuptk',Input::old('nuptk'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nuptk')}}
			</div>

			<div class="form-group">
				{{Form::label('email','Email',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::email('email',Input::old('email'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('email')}}
			</div>

			<div class="form-group">
				{{Form::label('nama','Nama Guru',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nama',Input::old('nama'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nama')}}
			</div>

			<div class="form-group">
				{{Form::label('tempat','Tempat Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tempat',Input::old('tempat'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tempat')}}
			</div>

			<div class="form-group">
				{{Form::label('tanggal','Tanggal Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<input type="text" id="tanggal" value="{{Input::old('tanggal')}}" class="form-control" name="tanggal">
				</div>
				{{$errors->first('tanggal')}}
			</div>

			<div class="form-group">
				{{Form::label('jk','JK',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="jk" class="form-control">
						<option></option>
						<option value="L">L</option>
						<option value="P">P</option>
					</select>
				</div>
				{{$errors->first('jk')}}
			</div>

			<div class="form-group">
				{{Form::label('pendidikan','Pendidikan Terakhir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('pendidikan',Input::old('pendidikan'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('pendidikan')}}
			</div>

			<div class="form-group">
				{{Form::label('tahun','tahun',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tahun',Input::old('tahun'),array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tahun')}}
			</div>

			<div class="form-group">
				{{Form::label('mulai','Mulai Kerja',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<input type="text" value="{{Input::old('mulai')}}" id="tanggal2" name="mulai" class="form-control">
				</div>
				{{$errors->first('mulai')}}
			</div>

			<div class="form-group">
				{{Form::label('foto','Foto',array('class'=>'col-lg-2 control-label'))}}
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
						Simpan
					</button>

					<a href="{{URL::to('admin/guru')}}" class="btn btn-default">Kembali</a>
				</div>
			</div>

		{{Form::close()}}
	</div>
@stop