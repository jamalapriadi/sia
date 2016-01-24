@extends('template.index')

@section('content')
	<legend>Sukses</legend>

	@if(Session::has('pesan'))
		<div class="alert alert-success">
			{{Session::get('pesan')}}
		</div>
	@endif

	
@stop