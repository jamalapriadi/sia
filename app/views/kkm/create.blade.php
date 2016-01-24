@extends('template.index')

@section('content')
	<legend>Tambah Nilai KKM</legend>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	{{Form::open(array('url'=>'admin/kkm','method'=>'post','class'=>'form-horizontal'))}}
		<div class="form-group">
			<label for="" class="col-sm-2 control-label">Tahun Ajaran</label>
			<div class="col-sm-4">
				<input type="text" readonly="readonly" name="tahun" value="{{$setting->dari_tahun.'-'.$setting->sampai_tahun}}" class="form-control">
			</div>
			{{$errors->first('tahun')}}
		</div>

		<div class="form-group">
			{{Form::label('mapel','Mata Pelajaran',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<select name="mapel" class="form-control">
					<option>--Pilih Mapel--</option>
					@foreach($mapel as $row)
						<option value="{{$row->kd_mapel}}">{{$row->nm_mapel}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="col-sm-2 control-label">Nilai KKM</label>
			<div class="col-sm-4">
				<input type="number" required="required" min="1" max="10" name="nilai" class="form-control">
			</div>
			{{$errors->first('nilai')}}
		</div>

		<div class="form-group well">
			{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-saved"></i>
					Simpan
				</button>

				<a href="{{URL::to('admin/kkm')}}" class="btn btn-default">Kembali</a>
			</div>
		</div>
	{{Form::close()}}
@stop
