@extends('template.index')

@section('content')
	<legend>Tambah Kategori</legend>
	{{Form::model($kategori,array('url'=>route('admin.kategori.update',['kategori'=>$kategori->id_kategori]),'method'=>'PUT','class'=>'form-horizontal'))}}
		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('nama','Nama Kategori',$kategori->nm_kategori,$errors)}}

		<div class="form-group well">
			{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-saved"></i>
					Update
				</button>

				<a href="{{URL::to('admin/kategori')}}" class="btn btn-default">
					Kembali
				</a>
			</div>
		</div>
	{{Form::close()}}
@stop