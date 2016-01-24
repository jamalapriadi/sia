@extends('template.index')

@section('content')
	<legend>Tambah Kategori</legend>
	{{Form::open(array('url'=>'admin/kategori','method'=>'post','class'=>'form-horizontal'))}}
		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('nama','Nama Kategori','',$errors)}}

		<div class="form-group well">
			{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-saved"></i>
					Simpan
				</button>

				<a href="{{URL::to('admin/kategori')}}" class="btn btn-default">
					Kembali
				</a>
			</div>
		</div>
	{{Form::close()}}
@stop