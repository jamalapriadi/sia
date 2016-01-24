@extends('template.index')

@section('content')
	<legend>Detail Siswa : {{$siswa->nisn}}</legend>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif


	<table class="table table-bordered">
		<tr>
			<td>NIS</td>
			<td>{{$siswa->nis}}</td>
		</tr>
		<tr>
			<td>NISN</td>
			<td>{{$siswa->nisn}}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{$siswa->email}}</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>{{$siswa->nm_siswa}}</td>
		</tr>
		<tr>
			<td>JK</td>
			<td>{{$siswa->jk}}</td>
		</tr>
		<tr>
			<td>Tempat / Tanggal Lahir</td>
			<td>{{$siswa->tmp_lahir." / ".date('d-m-Y',strtotime($siswa->tgl_lahir))}}</td>
		</tr>
		<tr>
			<td>Agama</td>
			<td>{{$siswa->agama}}</td>
		</tr>
		<tr>
			<td>Nama Ayah / Nama Ibu</td>
			<td>{{$siswa->nm_ayah." / ".$siswa->nm_ibu}}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>{{$siswa->alamat}}</td>
		</tr>
		<tr>
			<td>Tahun STTB</td>
			<td>{{$siswa->thn_sttb}}</td>
		</tr>
		<tr>
			<td>Foto</td>
			<td>
				<img src="{{URL::to('uploads/siswa/'.$siswa->foto)}}" style="max-height:200px;">
			</td>
		</tr>
	</table>

	<ul class="nav nav-tabs" id="myTab">
	  <li class="active"><a href="#home">Riwayat Rombel</a></li>
	</ul>

	<div class="tab-content">
	  <div class="tab-pane active" id="home">
			<br>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>
							No.
						</th>
						<th>
							Dari Rombel
						</th>
						<th>
							Ke Rombel
						</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=0;?>
					@foreach($riwayat as $row)
						<?php $no++;?>
						<tr>
							<td>
								{{$no}}
							</td>
							<td>
								{{$row->dari_rombel}}
							</td>
							<td>
								{{$row->ke_rombel}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="well">
		<a href="{{URL::to('admin/siswa')}}" class="btn btn-primary">Kembali</a>
	</div>
@stop
