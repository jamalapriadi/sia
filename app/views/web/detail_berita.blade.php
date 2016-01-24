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
			<a href="{{URL::to('detail_berita/'.$berita->id)}}">
				<h4>{{$berita->judul}}</h4>
			</a>
			
			{{HTML::image('uploads/berita/'.$berita->gambar)}}
				<p>{{$berita->isi}}</p>

			<br>

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.0";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			<div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5" data-colorscheme="light"></div>
		@stop
@stop
