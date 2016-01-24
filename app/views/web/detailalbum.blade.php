@extends('web.template')

@section('content')
	<legend>{{$album->nm_album}}</legend>

	<div class="row">
	@foreach($detail as $detail)
			<div class="col-md-6">
				<a href="#" class="lihat" foto="{{URL::to('uploads/gallery/'.$detail->foto)}}">
					<img src="{{URL::to('uploads/gallery/'.$detail->foto)}}" style="max-heigth:200px;
					max-width:200px; margin-bottom:10px;">
				</a>
			</div>
		
	@endforeach
	</div>

	<script>
		$(function(){
			$(".lihat").click(function(){
				var foto=$(this).attr("foto");

				$("#tampil").html("<img src='"+foto+"' width='550px'>");

				$("#myModal").modal("show");
			})
		})	
	</script>

	 <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Foto</h4>
                  </div>
                  <div class="modal-body" style="width:auto;">
                        <div id="tampil"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
@stop