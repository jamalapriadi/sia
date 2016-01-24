@extends('template.index')

@section('content')
	<legend>Kode Kelas : {{$kelas->kd_kelas}}</legend>
	<table class='table table-striped'>
		<tr>
			<td>{{$kelas->kelas}}</td>
			<td>{{$kelas->jurusan}}</td>
			<td>{{$kelas->sub_kela}}</td>
		</tr>
	</table>

	<div class="well">
		<a href="{{URL::to('admin/kelas')}}" class="btn btn-default">Kembali</a>
	</div>
@stop