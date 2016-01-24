<hr>
<table class="table table-striped">
	<thead>
		<tr>
			<th>No.</th>
			<th>ID Mengajar</th>
			<th>Mata Pelajaran</th>
			<th>Nilai KKM</th>
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
				<td>{{$row->id_mengajar}}</td>
				<td>{{$row->kd_mapel}}</td>
				<td>{{$row->nilai_kkm}}</td>
				<td>
					<a href="#" class="edit" mengajar="{{$row->id_mengajar}}" mapel="{{$row->kd_mapel}}" nilai="{{$row->nilai_kkm}}">
						<i class="glyphicon glyphicon-edit"></i>
					</a>
				</td>
				<td>
					<a href="#" class="hapus" kode="{{$row->id_mengajar}}">
						<i class="glyphicon glyphicon-trash"></i>
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
