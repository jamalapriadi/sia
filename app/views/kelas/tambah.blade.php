@extends('template.index')

@section('content')
	<div class="well">
		<legend>Tambah Kelas</legend>
		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif

		{{Form::open(array('url'=>'admin/kelas','method'=>'POST','class'=>'form-horizontal'))}}
			<div class="form-group">
				{{Form::label('kelas','Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="kelas" class="form-control">
						<option></option>
						<option value="VII">VII</option>
						<option value="VIII">VIII</option>
						<option value="IX">IX</option>
					</select>
				</div>
				{{$errors->first('kelas')}}
			</div>

			<div class="form-group">
				{{Form::label('sub','Sub Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="sub" class="form-control">
						<option></option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
						<option value="E">E</option>
						<option value="F">F</option>
						<option value="G">G</option>
						<option value="H">H</option>
					</select>
				</div>
				{{$errors->first('sub')}}
			</div>

			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						Simpan
					</button>

					<a href="{{URL::to('admin/kelas')}}" class="btn btn-default">Kembali</a>
				</div>
			</div>
		{{Form::close()}}
	</div>
@stop