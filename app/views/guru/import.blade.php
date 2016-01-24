@extends('template.index')

@section('content')
	<legend>Import Data Guru</legend>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	{{Form::open(array('url'=>'admin/import_guru','method'=>'post','class'=>'form-horizontal','files'=>true))}}
		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->file('excel','Import Data')}}

		{{$errors->first('excel')}}

		<div class="form-group well">
			{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-import"></i>
					Import
				</button>

				<a href="{{URL::to('admin/guru')}}" class="btn btn-default">
					Kembali
				</a>
			</div>
		</div>
	{{Form::close()}}
@stop