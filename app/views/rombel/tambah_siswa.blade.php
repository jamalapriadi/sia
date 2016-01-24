@extends('template.index')

@section('content')
	<style>
	.modal-dialog{
		width:400px;
		height: 100px;
	}
	</style>

	<script>
		$(function(){
			$("#simpan").click(function(){
				var rombel=$("#rombel").val();
            	var nis=$("#nis").val();
            	var nama=$("#nama").val();
            	var jk=$("#jk").val();

            	if(nis==""){
            		alert("Pilih dulu nis siswa");
            		$("#nis").focus();
            	}else if(nama==""){
            		alert("Nis Siswa tidak ditemukan");
            		$("#nis").focus();
            	}else if(jk==""){
            		alert("Nis Siswa tidak ditemukan");
            		$("#nis").focus();
            	}else{
            		$.ajax({
            			url:"{{URL::to('admin/simpan_siswa')}}",
            			type:"POST",
            			data:"nis="+nis+"&rombel="+rombel,
            			cache:false,
            			success:function(html){
            				$("#myModal2").modal("hide");
            				location.reload();
            			}
            		})
            	}
            });

            $('#myTab a').click(function (e) {
			  	e.preventDefault()
			  	$(this).tab('show')
			});

			$(".hapus").click(function(){
            	var nis=$(this).attr('kode');
            	var rombel=$(this).attr('rombel');

            	$("#idhapus").val(nis);
            	$("#idhapus2").val(rombel);
            	$("#myModal").modal("show");
            });

            $("#konfirmasi").click(function(){
            	var nis=$("#idhapus").val();
            	var rombel=$("#idhapus2").val();

            	$.ajax({
            		url:"{{URL::to('admin/hapus_siswa_rombel')}}",
            		type:"post",
            		data:"nis="+nis+"&rombel="+rombel,
            		cache:false,
            		success:function(html){
            			$("#myModal").modal("hide");
            			location.reload();
            		}
            	})
            })

			$(".tambah").click(function(){
				$("#myModal2").modal("show");
				$("#nis").val('');
				$("#nama").val('');
				$("#jk").val('');
				$("#nis").focus();
			});

			$("#nis").autocomplete({
                source:"{{URL::to('admin/cari_siswa')}}", //alamat yang dituju
                minLength:2, //cari setelah 2 karakter
                select: function( event, ui ) {
                	var nis=$("#nis").val();

                	$.ajax({
                		url:"{{URL::to('admin/get_siswa')}}",
                		type:"POST",
                		data:"nis="+nis,
                		cache:false,
                		success:function(msg){
                			data=msg.split("|");
                			$("#nama").val(data[0]);
                			$("#jk").val(data[1]);
                		}
                	})
                }
            });

            $("#nis").result(function(even,data,formatted){});
		});
	</script>
	<div class="row">
		<legend>Tambah Siswa</legend>
		<table class="table table-bordered">
			<tr>
				<td>ID Rombel</td>
				<input type="hidden" id="rombel" value="{{$rombel->kd_rombel}}">
				<td> : {{$rombel->kd_rombel}}</td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td> : {{$rombel->kd_kelas}}</td>
			</tr>
			<tr>
				<td>Tahun Ajaran</td>
				<td> : {{$rombel->thn_ajaran}}</td>
			</tr>
			<tr>
				<td>Wali Kelas</td>
				<td> : {{$rombel->id_wali." / ".$rombel->guru->nm_guru}}</td>
			</tr>
		</table>

		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif

		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#home">Data Siswa</a></li>
		  <li><a href="#profile">Import Data</a></li>
		</ul>

		<div class="tab-content">
		  <div class="tab-pane active" id="home">
		  	<br>

		  	<table class="table table-striped">
				<thead>
					<tr>
						<th>No.</th>
						<th>NIS</th>
						<th>Nama</th>
						<th>JK</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $no=0;?>
					@foreach($detail as $row)
					<?php $no++;?>
						<tr>
							<td>{{$no}}</td>
							<td>{{$row->nis}}</td>
							<td>{{$row->nm_siswa}}</td>
							<td>{{$row->jk}}</td>
							<td>
								<a href="#" class="hapus" kode="{{$row->nis}}" rombel="{{$rombel->kd_rombel}}">
									<i class="glyphicon glyphicon-trash"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		  </div>

		  <div class="tab-pane" id="profile">
		  	<br>
			{{Form::open(array('url'=>'admin/import_rombel','method'=>'post','class'=>'form-horizontal','files'=>true))}}
				<input type="hidden" name="rombel" value="{{$rombel->kd_rombel}}">
				{{Bootstrap::horizontal('col-sm-4','col-sm-2')
					->file('excel','Import File')}}

				<div class="form-group well">
					{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						<button class="btn btn-primary">
							<i class="glyphicon glyphicon-import"></i>
							Import
						</button>
					</div>
				</div>
			{{Form::close()}}
		  </div>
		</div>



	</div>

	<!-- Modal -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Pilih Siswa</h4>
		      </div>
		      <div class="modal-body">
		        @include('rombel.form_tambah_rombel')
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
@stop
