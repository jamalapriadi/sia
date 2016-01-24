@extends('template.index')

@section('content')
	<legend>Edit Berita</legend>
	{{Form::model($berita,array('url'=>route('admin.berita.update',['berita'=>$berita->id_berita]),'method'=>'PUT','class'=>'form-horizontal','files'=>true))}}
		<div class="row">
			<div class="col-md-8">
				{{Bootstrap::horizontal('col-sm-10','col-sm-2')
					->text('judul','Judul',$berita->judul,$errors)}}

				{{Bootstrap::horizontal('col-sm-10','col-sm-2')
					->textarea('isi','Isi',$berita->isi,$errors)}}

				<div class="form-group">
					{{Form::label('sampul','Sampul',array('class'=>'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{HTML::image('uploads/berita/'.$berita->gambar,'',array('style'=>'width:100px;'))}} 
					</div>
				</div>

				<div class="form-group">
					{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						<input type="file" name="gambar" class="form-control">
					</div>
				</div>
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
									@if($row->id_kategori==$berita->id_kategori)
										<input type="radio" name="kategori" value="{{$row->id_kategori}}" checked="checked"> {{$row->nm_kategori}}
									@else
										<input type="radio" name="kategori" value="{{$row->id_kategori}}"> {{$row->nm_kategori}}
									@endif
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