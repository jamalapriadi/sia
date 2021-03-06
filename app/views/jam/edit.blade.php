@extends('template.index')

@section('content')
	<legend>Edit Jam Pelajaran</legend>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	{{Form::model($jam,array('url'=>route('admin.jam.update',['jam'=>$jam->id]),'method'=>'PUT','class'=>'form-horizontal','files'=>true))}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->select('jam','Jam Ke - ',[$jam->jam_ke=>$jam->jam_ke,'1'=>'1','2'=>'2','3'=>'3','4'=>'4',
			'5'=>'5','6'=>'6','7'=>'7','8'=>'8'])}}

		<div class="form-group">
			{{Form::label('dari','Dari Jam',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<input type="time" name="dari" class="form-control" value="{{$jam->dari_jam}}">
			</div>
		</div>

		<div class="form-group">
			{{Form::label('sampai','Sampai Jam',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<input type="time" name="sampai" class="form-control" value="{{$jam->sampai_jam}}">
			</div>
		</div>

		<div class="form-group well">
			{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-saved"></i>
					Simpan
				</button>

				<a href="{{URL::to('admin/jam')}}" class="btn btn-default">
					Kembali
				</a>
			</div>
		</div>
	{{Form::close()}}
@stop