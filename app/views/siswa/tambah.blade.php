@extends('template.index')

@section('content')
	<script>
		$(function(){
			$("#tahun1").keypress(function(event){
				if ( event.which == 13 ) {
				    event.preventDefault();
				}
				
				var tahun1=eval($("#tahun1").val());

				var hasil=tahun1+1;

				$("#tahun2").val(hasil);
			});
		});
	</script>
	<div class="well">
		<legend>Tambah Data Siswa</legend>

		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif

		{{Form::open(array('url'=>'admin/siswa','method'=>'POST','class'=>'form-horizontal','files'=>true))}}
			<div class="form-group">
				{{Form::label('nis','NIS',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nis','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nis')}}
			</div>

			<div class="form-group">
				{{Form::label('nisn','NISN',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nisn','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nisn')}}
			</div>

			<div class="form-group">
				{{Form::label('email','Email',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::email('email','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('email')}}
			</div>

			<div class="form-group">
				{{Form::label('nama','Nama Siswa',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nama','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nama')}}
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
				{{Form::label('tempat','Tempat Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tempat','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tempat')}}
			</div>

			<div class="form-group">
				{{Form::label('tanggal','Tanggal Lahir',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<input type="text" id="tanggal" class="form-control" name="tanggal">
				</div>
				{{$errors->first('tanggal')}}
			</div>

			<div class="form-group">
				{{Form::label('agama','Agama',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="agama" class="form-control">
						<option></option>
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
					{{Form::text('ayah','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('ayah')}}
			</div>

			<div class="form-group">
				{{Form::label('ibu','Nama Ibu',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('ibu','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('ibu')}}
			</div>

			<div class="form-group">
				{{Form::label('alamat','Alamat',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('alamat','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('alamat')}}
			</div>

			<div class="form-group">
				{{Form::label('tahun','Tahun STTB',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tahun','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('tahun')}}
			</div>

			<div class="form-group">
				{{Form::label('diterima','Diterima di Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="kelas" id="kelas" class="form-control">
						<option>--Pilih Kelas</option>
						@foreach($kelas as $row)
							<option value="{{$row->kd_kelas}}">{{$row->kd_kelas}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				{{Form::label('tahun','Tahun Ajaran',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-2">
					<input type="number" value="{{$setting->dari_tahun}}" class="form-control" name="tahun1" id="tahun1">
				</div>
				<div class="col-lg-2">
					<input type="text" readonly="readonly" value="{{$setting->sampai_tahun}}" class="form-control" name="tahun2" id="tahun2">
				</div>
			</div>

			<div class="form-group">
				{{Form::label('foto','Foto',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::file('foto')}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-saved"></i>
						Simpan
					</button>

					<a href="{{URL::to('admin/siswa')}}" class="btn btn-default">Kembali</a>
				</div>
			</div>

		{{Form::close()}}
	</div>
@stop