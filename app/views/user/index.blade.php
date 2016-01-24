@extends('template.index')

@section('content')
	<legend>Data User</legend>
	<a href="{{URL::to('admin/user/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Admin
	</a>

	@if(Session::has('pesan'))
		<hr>
		{{Session::get('pesan')}}
	@endif

	<table class="table table-striped" id="contoh">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Level</th>
				<th>Activated</th>
				<th>Activated At</th>
				<th>Last Login</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($user as $row)
				<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->username}}</td>
					<td>{{$row->name}}</td>
					<td>
						@if($row->activated==0)
							Tidak Aktif
						@else
							Aktif
						@endif
					</td>
					<td>{{$row->activated_at}}</td>
					<td>{{$row->last_login}}</td>
					<td>
							@if($row->activated==0)
								<a href="#" user="{{$row->iduser}}" class="btn btn-warning aktif" title="Tidak Aktif">
									<i class="glyphicon glyphicon-thumbs-down"></i>
								</a>
							@else
								<a href="#" user="{{$row->iduser}}" class="btn btn-success nonaktif" title="Aktif">
									<i class="glyphicon glyphicon-thumbs-up"></i>
								</a>
							@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<!-- Modal -->
	<div class="modal fade" id="proses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Proses</h4>
				</div>
				<div class="modal-body">
					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							<span class="sr-only">40% Complete (success)</span>
						</div>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>
		$(function(){
			$(".aktif").click(function(){
				var user=$(this).attr("user");

				$("#proses").modal("show");

				$.ajax({
					url:"{{URL::to('admin/aktivasi_user')}}",
					type:"POST",
					data:"user="+user,
					cache:false,
					success:function(html){
						location.reload();
					}
				})
			})

			$(".nonaktif").click(function(){
				var user=$(this).attr("user");

				$("#proses").modal("show");

				$.ajax({
					url:"{{URL::to('admin/nonaktif_user')}}",
					type:"POST",
					data:"user="+user,
					cache:false,
					success:function(html){
						location.reload();
					}
				})
			})
		})
	</script>
@stop
