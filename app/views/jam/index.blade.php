@extends('template.index')

@section('content')
	<legend>Jam Pelajaran</legend>

	<a href="{{URL::to('admin/jam/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Jam
	</a>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>No.</th>
				<th>Jam Ke - </th>
				<th>Dari Jam</th>
				<th>Sampai Jam</th>
				<th></th>
			</tr>
		</thead>
		<tbody>	
			<?php $no=0;?>
			@foreach($jam as $row)
			<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->jam_ke}}</td>
					<td>{{$row->dari_jam}}</td>
					<td>{{$row->sampai_jam}}</td>
					<td>
						{{Form::open(array('url'=>'admin/jam/'.$row->jam_ke))}}
							{{Form::hidden('_method','DELETE')}}
							{{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
						{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop