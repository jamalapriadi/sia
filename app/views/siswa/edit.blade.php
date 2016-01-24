@extends('template.index')

@section('content')
	<div class="well">
		<legend>Tambah Data Siswa</legend>

		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif

		{{Form::model($siswa,array('url'=>route('admin.siswa.update',['siswa'=>$siswa->id]),'method'=>'PUT','class'=>'form-horizontal','files'=>true))}}
			<div class="form-group">
				{{Form::label('nis','NIS',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nis',$siswa->nis,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nis')}}
			</div>

			<div class="form-group">
				{{Form::label('nisn','NISN',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nisn',$siswa->nisn,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nisn')}}
			</div>

			<div class="form-group">
				{{Form::label('email','Email',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::email('email',$siswa->email,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('email')}}
			</div>

			<div class="form-group">
				{{Form::label('nama','Nama Siswa',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nama',$siswa->nm_siswa,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nama')}}
			</div>

			<div class="form-group">
				{{Form::label('jk','JK',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="jk" class="form-control">
						<option value="{{$siswa->jk}}">{{$siswa->jk}}</option>
						<option value="L">L</option>
						<option value="P">P</option>
					</select>
				</div>
				{{$errors->first('jk')}}
			</div>

			<div class="form-group">
				{{Form::label('tempat','Tempat Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tempat',$siswa->tmp_lahir,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tempat')}}
			</div>

			<div class="form-group">
				{{Form::label('tanggal','Tanggal Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<input type="text" id="tanggal" value="{{date('d-m-Y',strtotime($siswa->tgl_lahir))}}" class="form-control" name="tanggal">
				</div>
				{{$errors->first('tanggal')}}
			</div>

			<div class="form-group">
				{{Form::label('agama','Agama',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="agama" class="form-control">
						<option value="{{$siswa->agama}}">{{$siswa->agama}}</option>
						<option value="Islam">Islam</option>
						<option value="Kristen">Kristen</option>
						<option value="Hindu">Hindu</option>
						<option value="Budha">Budha</option>
						<option value="Protestan">Protestan</option>
					</select>
				</div>
				{{$errors->first('agama')}}
			</div>

			<div class="form-group">
				{{Form::label('ayah','Nama Ayah',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('ayah',$siswa->nm_ayah,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('ayah')}}
			</div>

			<div class="form-group">
				{{Form::label('ibu','Nama Ibu',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('ibu',$siswa->nm_ibu,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('ibu')}}
			</div>

			<div class="form-group">
				{{Form::label('alamat','Alamat',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('alamat',$siswa->alamat,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('alamat')}}
			</div>

			<div class="form-group">
				{{Form::label('tahun','Tahun STTB',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tahun',$siswa->thn_sttb,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tahun')}}
			</div>

			<div class="form-group">
				{{Form::label('foto','Foto',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<img src="{{URL::to('uploads/siswa/'.$siswa->foto)}}" style="max-height:200px;">
				</div>
			</div>

			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::file('foto')}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-saved"></i>
						Update
					</button>

					<a href="{{URL::to('admin/siswa')}}" class="btn btn-default">Kembali</a>
				</div>
			</div>

		{{Form::close()}}
	</div>
@stop