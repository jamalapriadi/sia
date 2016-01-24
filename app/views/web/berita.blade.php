@extends('web.template')

@section('content')
	<style>
		img{
			max-height: 200px;
			float: left;
			margin-right: 10px;
		}
		p{
			line-height: 200%;
			text-align: justify;
		}
	</style>

	<legend>Berita</legend>
		@foreach($berita as $berita)
			<a href="{{URL::to('detail_berita/'.$berita->id_berita)}}">
				<h4>{{$berita->judul}}</h4>
			</a>

			{{HTML::image('uploads/berita/'.$berita->gambar,'',array('style'=>'width:100%;height:200px;'))}}
				<p>{{substr($berita->isi,0,900)}}</p>

			<hr>
		@endforeach
@stop