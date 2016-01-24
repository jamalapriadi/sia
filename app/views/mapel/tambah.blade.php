@extends('template.index')

@section('content')
	<div class="well">
		<legend>Tambah Mata Pelajaran</legend>
		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif
		
		{{Form::open(array('url'=>'admin/mapel','method'=>'post','class'=>'form-horizontal'))}}
			<div class="form-group">	
				{{Form::label('kode','Kode Mapel',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('kode','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('kode')}}
			</div>

			<div class="form-group">
				{{Form::label('nama','Nama Mapel',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nama','',array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nama')}}
			</div>

			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-saved"></i>
						Simpan
					</button>

					<a href="{{URL::to('admin/mapel')}}" class="btn btn-default">
						Kembali
					</a>
				</div>
			</div>
		{{Form::close()}}
	</div>
@stop