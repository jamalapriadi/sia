@extends('template.index')

@section('content')
	
	<legend>Tambah Data Mengajar</legend>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	{{Form::open(array('url'=>'admin/mengajar','method'=>'post','class'=>'form-horizontal'))}}
		<div class="form-group">	
			{{Form::label('guru','Nama Guru',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				<select name="guru" id="guru" class="form-control">
					<option></option>
					@foreach($guru as $row)
						<option value="{{$row->id}}">{{$row->nm_guru}}</option>
					@endforeach
				</select>
			</div>
			{{$errors->first('guru')}}
		</div>

		<div class="form-group">	
			{{Form::label('guru','Mapel',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				<select name="mapel" id="mapel" class="form-control" required="required">
					<option></option>
					@foreach($mapel as $row)
						<option value="{{$row->kd_mapel}}">{{$row->nm_mapel}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">	
			{{Form::label('tahun','Tahun Ajaran',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				<input type="text" readonly="readonly" name="tahun" class="form-control" value="{{$setting->dari_tahun.'-'.$setting->sampai_tahun}}">
			</div>
		</div>

		<div class="form-group well">
			{{Form::label('','',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-saved"></i>
					Simpan
				</button>

				<a href="{{URL::to('admin/mengajar')}}" class="btn btn-default">
					Kembali
				</a>
			</div>
		</div>

	</form>
@stop