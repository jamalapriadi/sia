@extends('template.index')

@section('content')
	<div class="well">
		<legend>Edit Kelas : {{$kelas->kd_kelas}}</legend>
		{{Form::model($kelas,array('url'=>route('admin.kelas.update',['kelas'=>$kelas->id_kelas]),'Method'=>'PUT','class'=>'form-horizontal'))}}

			<div class="form-group">
				{{Form::label('kelas','Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="kelas" class="form-control">
						<option value="{{$kelas->kelas}}">{{$kelas->kelas}}</option>
						<option value="X">X</option>
						<option value="XI">XI</option>
						<option value="XII">XII</option>
					</select>
				</div>
				{{$errors->first('kelas')}}
			</div>

			<div class="form-group">
				{{Form::label('jurusan','Jurusan',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="jurusan" class="form-control">
						<option value="{{$kelas->jurusan}}">{{$kelas->jurusan}}</option>
						<option value="MIA">MIA</option>
						<option value="IIS">IIS</option>
						<option value="IPA">IPA</option>
						<option value="IPS">IPS</option>
					</select>
				</div>
				{{$errors->first('jurusan')}}
			</div>

			<div class="form-group">
				{{Form::label('sub','Sub Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="sub" class="form-control">
						<option value="{{$kelas->sub_kelas}}">{{$kelas->sub_kelas}}</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
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