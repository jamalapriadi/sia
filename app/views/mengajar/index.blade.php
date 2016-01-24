@extends('template.index')

@section('content')
	<legend>Mengajar</legend>

	<a href="{{URL::to('admin/mengajar/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Input Data Mengajar
	</a>

	<a href="{{URL::to('admin/import_mengajar')}}" class="btn btn-success">
		<i class="glyphicon glyphicon-import"></i>
		Import Data
	</a>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>No.</th>
				<th>NIP</th>
				<th>NUPTK</th>
				<th>Nama</th>
				<th>Mapel</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($mengajar as $row)
			<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->guru->nip}}</td>
					<td>{{$row->guru->nuptk}}</td>
					<td>{{$row->guru->nm_guru}}</td>
					<td>{{$row->mapel->nm_mapel}}</td>
					<td>
						<a href="{{URL::to('admin/mengajar/'.$row->id.'/edit')}}" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i>
						</a>
					</td>
					<td>
						{{Form::open(array('url'=>'admin/mengajar/'.$row->id))}}
							{{Form::hidden('_method','DELETE')}}
							{{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
						{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
