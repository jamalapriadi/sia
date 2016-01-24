@extends('template.index')

@section('content')
	<legend>Tambah Berita</legend>
	{{Form::open(array('url'=>'admin/berita','method'=>'post','class'=>'form-horizontal','files'=>true))}}
		<div class="row">
			<div class="col-md-8">
				{{Bootstrap::horizontal('col-sm-10','col-sm-2')
					->text('judul','Judul','',$errors)}}

				{{Bootstrap::horizontal('col-sm-10','col-sm-2')
					->textarea('isi','Isi','',$errors)}}

				{{Bootstrap::horizontal('col-sm-10','col-sm-2')
					->file('gambar','Sampul')}}
			</div>

			<div class="col-md-4">
				<div class="panel panel-primary">	
					<div class="panel-heading">
						<p>Kategori</p>
					</div>
					<div class="panel-body">
						<ul class="list-unstyled">
							@foreach($kategori as $row)
								<li>
									<input type="radio" name="kategori" value="{{$row->id_kategori}}"> {{$row->nm_kategori}}
								</li>
							@endforeach
							{{$errors->first('kategori')}}
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group well">
			<div class="pull pull-right">
				<a href="{{URL::to('admin/berita')}}" class="btn btn-default">
					Kembali
				</a>
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-saved"></i>
					Simpan
				</button>
			</div>
		</div>
	{{Form::close()}}
@stop