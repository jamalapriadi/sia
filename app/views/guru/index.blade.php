@extends('template.index')

@section('content')
	<legend>Data Guru</legend>

	<div class="row">
		<div class="col-md-6">
			<a href="{{URL::to('admin/guru/create')}}" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i>
				Tambah Guru
			</a>

			<a href="{{URL::to('admin/import_guru')}}" class="btn btn-success">
				<i class="glyphicon glyphicon-import"></i>
				Import
			</a>
		</div>
	</div>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>#</th>
				<th>ID Guru</th>
				<th>NIP</th>
				<th>NUPTK</th>
				<th>Nama</th>
				<th>Tempat / Tgl. Lahir</th>
				<th>JK</th>
				<th>Pendidikan</th>
				<th>Tahun</th>
				<th>Mulai Kerja</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php $no=0; ?>
		@foreach($guru as $row)
		<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$row->id}}</td>
				<td>{{$row->nip}}</td>
				<td>{{$row->nuptk}}</td>
				<td>{{$row->nm_guru}}</td>
				<td>{{$row->tmp_lahir." / ".date('d-m-Y',strtotime($row->tgl_lahir))}}</td>
				<td>{{$row->jk}}</td>
				<td>{{$row->pend_terakhir}}</td>
				<td>{{$row->tahun}}</td>
				<td>{{date('d-m-Y',strtotime($row->mulai_kerja))}}</td>
				<td>
					<a href="{{URL::to('admin/guru/'.$row->id)}}">
						<i class="glyphicon glyphicon-list-alt"></i>
					</a>
				</td>
				<td>
					<a href="{{URL::to('admin/guru/'.$row->id.'/edit')}}">
						<i class="glyphicon glyphicon-edit"></i>
					</a>
				</td>
				<td>
					{{Form::open(array('url'=>'admin/guru/'.$row->id))}}
						{{Form::hidden('_method','DELETE')}}
						{{Form::submit('Hapus',array('class'=>'btn btn-danger'))}}
					{{Form::close()}}
				</td>
			</tr>
		@endforeach
	</table>
@stop
