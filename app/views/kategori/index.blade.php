@extends('template.index')

@section('content')
	<legend>Kategori</legend>

	<a href="{{URL::to('admin/kategori/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Kategori
	</a>

	@if(Session::has('pesan'))
		<hr>
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Kategori</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($kategori as $row)
				<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->nm_kategori}}</td>
					<td><a href="{{URL::to('admin/kategori/'.$row->id_kategori.'/edit')}}">
						<i class="glyphicon glyphicon-edit"></i>
						</a>
					</td>
					<td>
						{{Form::open(array('url'=>'admin/kategori/'.$row->id_kategori))}}
							{{Form::hidden('_method','DELETE')}}
							{{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
						{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop