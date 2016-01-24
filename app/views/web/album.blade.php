@extends('web.template')

@section('content')
	{{HTML::script('assets/js/jquery.cycle.all.js')}}
	{{HTML::script('assets/js/jquery.easing.1.3.js')}}

	<script type="text/javascript">
		$.fn.cycle.defaults.speed   = 900;
		$.fn.cycle.defaults.timeout = 6000;

		$(function() {
	    // run the code in the markup!
	    	$('.thumbnails').cycle();

		});
	</script>

	<legend>Gallery</legend>

	<div class="row">
		@foreach($album as $row)
			<div class="col-md-6">
				<div class="thumbnails">
					<?php $detail=DB::table('detail_album')->where('id_album','=',$row->id_album)->get();?>
					@foreach($detail as $det)
						<img src="{{URL::to('uploads/gallery/'.$det->foto)}}" style="max-height:200px; max-width:200px; ">
					@endforeach
				</div>
				<a href="{{URL::to('detail_gallery/'.$row->id_album)}}"><h3>{{$row->nm_album}}</h3></a>
			</div>
		@endforeach
	</div>
@stop