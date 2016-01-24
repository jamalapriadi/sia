@extends('template.index')

@section('content')
	<legend>Data Kelas</legend>
	<a href="{{URL::to('admin/kelas/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Kelas
	</a>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>#</th>
				<th>Kode Kelas</th>
				<th>Kelas</th>
				<th>Sub Kelas</th>
				<th></th>
			</tr>
		</thead>
		<?php $no=0;?>
		@foreach($kelas as $row)
		<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$row->kd_kelas}}</td>
				<td>{{$row->kelas}}</td>
				<td>{{$row->subkelas}}</td>
				<td>
					{{Form::open(array('url'=>'admin/kelas/'.$row->kd_kelas))}}
						{{Form::hidden('_method','DELETE')}}
						{{Form::submit('hapus',array('class'=>'btn btn-danger'))}}
					{{Form::close()}}
				</td>
			</tr>
		@endforeach
	</table>
@stop