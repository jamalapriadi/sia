@extends('template.index')

@section('content')
	<legend>Data Rombel</legend>

	<a href="{{URL::to('admin/rombel/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Rombel
	</a>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>No.</th>
				<th>Kd Rombel</th>
				<th>Kelas</th>
				<th>Tahun Ajaran</th>
				<th>Wali</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($rombel as $row)
			<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->kd_rombel}}</td>
					<td>{{$row->kd_kelas}}</td>
					<td>{{$row->thn_ajaran}}</td>
					<td>{{$row->guru->nm_guru}}</td>
					<td>
						<a class="btn btn-success" title="Edit Rombel" href="{{URL::to('admin/rombel/'.$row->kd_rombel.'/tambah_siswa')}}">
							<i class="glyphicon glyphicon-user"></i>
							Data Siswa
						</a>
					</td>
					<td>
						<a class="btn btn-warning" title="Edit Rombel" href="{{URL::to('admin/rombel/'.$row->kd_rombel.'/edit')}}">
							<i class="glyphicon glyphicon-edit"></i>
							Ganti Wali Kelas
						</a>
					</td>
					<td>
						{{Form::open(array('url'=>'admin/rombel/'.$row->kd_rombel))}}
							{{Form::hidden('_method','DELETE')}}
							<button class="btn btn-danger">
								<i class="glyphicon glyphicon-trash"></i>
								Hapus
							</button>
						{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
