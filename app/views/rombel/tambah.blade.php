@extends('template.index')

@section('content')
	<div class="well">
		<legend>Tambah Rombel</legend>

		@if(Session::get('pesan'))
			{{Session::get('pesan')}}
		@endif

		{{Form::open(array('url'=>'admin/rombel','method'=>'POST','class'=>'form-horizontal'))}}
			<div class="form-group">	
				{{Form::label('kelas','Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="kelas" class="form-control">
						<option></option>
						@foreach($kelas as $kelas)
							<option value="{{$kelas->kd_kelas}}">{{$kelas->kd_kelas}}</option>
						@endforeach
					</select>
				</div>
				{{$errors->first('kelas')}}
			</div>

			<div class="form-group">
				{{Form::label('tahun','Tahun Ajaran',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tahun',$setting->dari_tahun.'-'.$setting->sampai_tahun,array('class'=>'form-control','readonly'=>'readonly'))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('nip','NIP',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="nip" class="form-control">
						<option></option>
						@foreach($guru as $guru)
							<option value="{{$guru->id}}">{{$guru->nm_guru}}</option>
						@endforeach
					</select>
				</div>
				{{$errors->first('nip')}}
			</div>

			<hr>
			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-saved"></i>
						Simpan
					</button>

					<a href="{{URL::to('admin/rombel')}}" class="btn btn-default">Kembali</a>
				</div>
			</div>
		{{Form::close()}}
	</div>
@stop