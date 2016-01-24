@extends('web.template')

@section('content')
	<legend>Kontak Kami</legend>


		<table class="table table-striped">
			<tr>
				<td>Nama</td>
				<td>{{$profile->nm_sekolah}}</td>
			</tr>
			<tr>
				<td>NSS</td>
				<td>{{$profile->nss}}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>{{$profile->alamat_sekolah}}</td>
			</tr>
			<tr>
				<td>Kecamatan</td>
				<td>{{$profile->kecamatan}}</td>
			</tr>
			<tr>
				<td>Kabupaten</td>
				<td>{{$profile->kabupaten}}</td>
			</tr>
			<tr>
				<td>Telp</td>
				<td>{{$profile->telp_sekolah}}</td>
			</tr>
			<tr>
				<td>Fax</td>
				<td>{{$profile->fax_sekolah}}</td>
			</tr>
		</table>


@stop
