@extends('template.index')

@section('content')
	<legend>Jadwal Mengajar</legend>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Kelas</th>
				<th>Tahun Ajaran</th>
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
					<td>{{$row->kd_kelas}}</td>
					<td>{{$row->thn_ajaran}}</td>
					<td>
						<a href="{{URL::to('admin/lihat_jadwal/'.$row->kd_rombel)}}" class="btn btn-warning">
							<i class="glyphicon glyphicon-list-alt"></i>
							Lihat Jadwal
						</a>
					</td>
					<td>
						<a href="{{URL::to('admin/setting_jadwal/'.$row->kd_rombel)}}" class="btn btn-primary">
							<i class="glyphicon glyphicon-th"></i>
							Setting Jadwal
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop