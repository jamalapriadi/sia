@extends('template.index')

@section('content')
	<legend>Data Siswa Rombel : {{$rombel->id_rombel}}</legend>

	<table class="table table-bordered">	
			<tr>
				<td>ID Rombel</td>
				<input type="hidden" id="rombel" value="{{$rombel->id_rombel}}">
				<td> : {{$rombel->id_rombel}}</td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td> : {{$rombel->kd_kelas}}</td>
			</tr>
			<tr>
				<td>Tahun Ajaran</td>
				<td> : {{$rombel->dari_tahun." - ".$rombel->sampai_tahun}}</td>
			</tr>
			<tr>
				<td>Wali Kelas</td>
				<td> : {{$rombel->nip." / ".$rombel->guru->nm_guru}}</td>
			</tr>
		</table>


	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
			</tr>
		</thead>
		<?php $no=0;?>
		@foreach($siswa as $row)
		<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$row->nisn}}</td>
				<td>{{$row->nm_siswa}}</td>
			</tr>
		@endforeach
	</table>
@stop