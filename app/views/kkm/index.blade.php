@extends('template.index')

@section('content')
	<legend>Data KKM</legend>

	<a href="{{URL::to('admin/kkm/create')}}" class="btn btn-primary">
		<i class="gpylhicon glyphicon-plus"></i>
		Tambah KKM
	</a>

	@if(Session::has('pesan'))
		<hr>
		{{Session::get('pesan')}}
	@endif

	<table  class="table table-striped table-bordered" id="contoh">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tahun Ajaran</th>
				<th>Mata Pelajaran</th>
				<th>Nilai KKM</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($kkm as $row)
				<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->thn_ajaran}}</td>
					<td>{{$row->mapel->nm_mapel}}</td>
					<td>{{$row->nilai_kkm}}</td>
					<td>
						<a href="{{URL::to('admin/kkm/'.$row->id.'/edit')}}" class="btn btn-warning">
							<i class="glyphicon glyphicon-edit"></i>
						</a>
					</td>
					<td>
						{{Form::open(array('url'=>'admin/kkm/'.$row->id))}}
							{{Form::hidden('_method','DELETE')}}
							{{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
						{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop