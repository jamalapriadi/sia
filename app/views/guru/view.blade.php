@extends('template.index')

@section('content')
	<legend>Detail Guru : {{$guru->nip}}</legend>

	<table class="table table-bordered">
		<tr>
			<td>ID Guru</td>
			<td> : {{$guru->id}}</td>
		</tr>
		<tr>
			<td>NIP</td>
			<td> : {{$guru->nip}}</td>
		</tr>
		<tr>
			<td>NUPTK</td>
			<td> : {{$guru->nuptk}}</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td> : {{$guru->nm_guru}}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td> : {{$guru->email}}</td>
		</tr>
		<tr>
			<td>Tempat / Tanggal Lahir</td>
			<td> : {{$guru->tmp_lahir." / ".date('d-m-Y',strtotime($guru->tgl_lahir))}}</td>
		</tr>
		<tr>
			<td>JK</td>
			<td> : {{$guru->jk}}</td>
		</tr>
		<tr>
			<td>Pendidikan Terakhir</td>
			<td> : {{$guru->pend_terakhir}}</td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td> : {{$guru->tahun}}</td>
		</tr>
		<tr>
			<td>Mulai Kerja</td>
			<td> : {{date('d-m-Y',strtotime($guru->mulai_kerja))}}</td>
		</tr>
		<tr>
			<td>Foto</td>
			<td> : <img src="{{URL::to('uploads/guru/'.$guru->foto)}}" style="max-height:200px;">
		</td>
	</table>

	<div class="well">
		<a href="{{URL::to('admin/guru')}}" class="btn btn-primary">Kembali</a>
	</div>
@stop