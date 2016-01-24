@extends('template.index')

@section('content')
	<legend>Data Guru</legend>

	<div class="row">
		<div class="col-md-6">
			<a href="{{URL::to('guru/create')}}" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i>
				Tambah Pegawai
			</a>
		</div>

		<div class="col-md-6">
			{{Form::open(array('url'=>'cari_guru','method'=>'post'))}}
				<div class="input-group">
			      	<input type="text" name="cari" class="form-control" placeholder="Cari NiP / Nama Guru">
			      	<span class="input-group-btn">
			        	<button class="btn btn-default" type="button">Cari</button>
			      	</span>
			    </div>
			{{Form::close()}}
		</div>
	</div>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>NIP</th>
				<th>NUPTK</th>
				<th>Nama</th>
				<th>Tempat / Tgl. Lahir</th>
				<th>JK</th>
				<th>Pendidikan</th>
				<th>Tahun</th>
				<th>Mulai Kerja</th>
				<th colspan="3"></th>
			</tr>
		</thead>
		<?php $no=0; ?>
		@foreach($guru as $guru)
		<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$guru->nip}}</td>
				<td>{{$guru->nuptk}}</td>
				<td>{{$guru->nm_guru}}</td>
				<td>{{$guru->tmp_lahir." / ".date('d-m-Y',strtotime($guru->tgl_lahir))}}</td>
				<td>{{$guru->jk}}</td>
				<td>{{$guru->pend_terakhir}}</td>
				<td>{{$guru->tahun}}</td>
				<td>{{date('d-m-Y',strtotime($guru->mulai_kerja))}}</td>
				<td>
					<a href="{{URL::to('guru/'.$guru->nip)}}">
						<i class="glyphicon glyphicon-list-alt"></i>
					</a>
				</td>
				<td>
					<a href="{{URL::to('guru/'.$guru->nip.'/edit')}}">
						<i class="glyphicon glyphicon-edit"></i>
					</a>
				</td>
				<td>
					{{Form::open(array('url'=>'guru/'.$guru->nip))}}
						{{Form::hidden('_method','DELETE')}}
						{{Form::submit('hapus',array('class'=>'btn btn-danger'))}}
					{{Form::close()}}
				</td>
			</tr>
		@endforeach
	</table>
@stop