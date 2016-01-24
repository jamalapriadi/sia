@extends('template.index')

@section('content')
	<div class="well">	
		<legend>Edit Mapel : {{$mapel->kd_mapel}}</legend>

		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif
		{{Form::model($mapel,array('url'=>route('admin.mapel.update',['mapel'=>$mapel->kd_mapel]),'method'=>'PUT','class'=>'form-horizontal'))}}
			<div class="form-group">	
				{{Form::label('kode','Kode Mapel',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('kode',$mapel->kd_mapel,array('class'=>'form-control','readonly'=>'readonly'))}}
				</div>
				{{$errors->first('kode')}}
			</div>

			<div class="form-group">
				{{Form::label('nama','Nama Mapel',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('nama',$mapel->nm_mapel,array('class'=>'form-control'))}}
				</div>
				{{$errors->first('nama')}}
			</div>

			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-saved"></i>
						Update
					</button>

					<a href="{{URL::to('admin/mapel')}}" class="btn btn-default">
						Kembali
					</a>
				</div>
			</div>
		{{Form::close()}}
	</div>
@stop