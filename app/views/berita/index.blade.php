@extends('template.index')

@section('content')
	<legend>Berita</legend>

	<a href="{{URL::to('admin/berita/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Berita
	</a>

	@if(Session::has('pesan'))
		<hr>
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>No.</th>
				<th>Kategori</th>
				<th>Judul</th>
				<th>Created At</th>
				<th>Update At</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($berita as $row)
				<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->kategori->nm_kategori}}</td>
					<td>{{$row->judul}}</td>
					<td>{{$row->created_at}}</td>
					<td>{{$row->updated_at}}</td>
					<td>
						<a href="{{URL::to('admin/berita/'.$row->id_berita.'/edit')}}">
							<i class="glyphicon glyphicon-edit"></i>
						</a>
					</td>
					<td>
						{{Form::open(array('url'=>'admin/berita/'.$row->id_berita))}}
							{{Form::hidden('_method','DELETE')}}
							{{Form::submit('hapus',array('class'=>'btn btn-danger'))}}
						{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
