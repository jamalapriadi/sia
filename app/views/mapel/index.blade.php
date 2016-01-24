@extends('template.index')

@section('content')
	<legend>Mata Pelajaran</legend>
	<a href="{{URL::to('admin/mapel/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Mapel
	</a>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>#</th>
				<th>Kode Mapel</th>
				<th>Nama Mapel</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php $no=0; ?>
		@foreach($mapel as $row)
		<?php $no++;?>
		<tr>
			<td>{{$no}}</td>
			<td>{{$row->kd_mapel}}</td>
			<td>{{$row->nm_mapel}}</td>
			<td>
				<a href="{{URL::to('admin/mapel/'.$row->kd_mapel.'/edit')}}">
					<i class="glyphicon glyphicon-edit"></i>
				</a>
			</td>
			<td>
				{{Form::open(array('url'=>'admin/mapel/'.$row->kd_mapel))}}
					{{Form::hidden('_method','DELETE')}}
					{{Form::submit('hapus',array('class'=>'btn btn-danger'))}}
				{{Form::close()}}
			</td>
		</tr>
		@endforeach
	</table>
@stop