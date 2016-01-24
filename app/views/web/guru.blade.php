@extends('web.template')

@section('content')
	<legend>Data Guru</legend>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>NIP</th>
				<th>Nama</th>
				<th>Tempat / Tgl. Lahir</th>
				<th>JK</th>
			</tr>
		</thead>
		<?php $no=0; ?>
		@foreach($guru as $guru)
		<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$guru->nip}}</td>
				<td>{{$guru->nm_guru}}</td>
				<td>{{$guru->tmp_lahir." / ".$guru->tgl_lahir}}</td>
				<td>{{$guru->jk}}</td>
			</tr>
		@endforeach
	</table>
@stop