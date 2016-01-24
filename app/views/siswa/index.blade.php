@extends('template.index')

@section('content')
	<legend>Data Siswa</legend>

	<a href="{{URL::to('admin/siswa/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Tambah Siswa
	</a> 

	<a href="{{URL::to('admin/import_siswa')}}" class="btn btn-success">
		<i class="glyphicon glyphicon-import"></i>
		Import
	</a>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<table class="table table-stripped" id="contoh">
		<thead>
			<tr>
				<th>No</th>
				<th>NIS</th>
				<th>NISN</th>
				<th>Nama</th>
				<th>JK</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($siswa as $row)
				<?php $no++;?>
				<tr>
					<td>{{$no}}</td>
					<td>{{$row->nis}}</td>
					<td>{{$row->nisn}}</td>
					<td>{{$row->nm_siswa}}</td>
					<td>{{$row->jk}}</td>
					<td>
						<a href="{{URL::to('admin/siswa/'.$row->id)}}">
							<i class="glyphicon glyphicon-list-alt"></i>
						</a>
					</td>
					<td>
						<a href="{{URL::to('admin/siswa/'.$row->id.'/edit')}}">
							<i class="glyphicon glyphicon-edit"></i>
						</a>
					</td>
					<td>
						{{Form::open(array('url'=>'admin/siswa/'.$row->id))}}
							{{Form::hidden('_method','DELETE')}}
							{{Form::submit('hapus',array('class'=>'btn btn-danger'))}}
						{{Form::close()}}
					</a>
				</tr>
			@endforeach
		</tbody>
	</table>

	<script>
	$(function(){
	    $(".hapus").click(function(){
		 	var nis=$(this).attr("kode");

		 	$("#idhapus").val(nis);
		 	$("#myModal").modal("show");
		});
	 
	    $('#konfirmasi').click( function () {
	    	var nis=$("#idhapus").val();

	    	$.ajax({
	    		url:"{{URL::to('admin/siswa/hapus')}}",
	    		type:"POST",
	    		data:"nis="+nis,
	    		cache:false,
	    		success:function(html){
	    			$("#myModal").modal("hide");
	        		table.row('.selected').remove().draw( false );
	        		$("#pesan").html(html);
	    		}
	    	})
	    } );
	});
	</script>
@stop