@extends('template.index')

@section('content')
	<legend>Jadwal Pelajaran</legend>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	<div>
		<table class="table table-bordered">
			<tr>
				<td>Kelas</td>
				<td> : </td>
				<td>{{$rombel->kd_kelas}}</td>
			</tr>
			<tr>
				<td>Tahun Ajaran</td>
				<td> : </td>
				<td>{{$rombel->thn_ajaran}}</td>
			</tr>
		</table>

		<a class="btn btn-success" data-toggle="modal" href="#myModal">
			<i class="glyphicon glyphicon-plus"></i>
			Input Jadwal
		</a>
	</div>

	<hr>

	<div class="row">
		<div class="col-sm-6">
			<panel class="panel-primary">
				<div class="panel-heading">
					<p>Senin</p>
				</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td>Jam Ke -</td>
								<td>Jam</td>
								<td>ID Guru</td>
								<td>Mapel</td>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$senin=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
									->where('hari','=','Senin')
									->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
									->get();
							?>
							@foreach($senin as $sen)
							<tr>
								<td>{{$sen->jam_ke}}</td>
								<td>{{$sen->dari_jam.' - '.$sen->sampai_jam}}</td>
								<?php
									$mengajar=DB::table('mengajar')->where('id_guru','=',$sen->id_guru)
									->first();
								?>
								<td>{{$sen->id_guru}}</td>
								<td>{{$mengajar->kd_mapel}}</td>
								<td>
									<a href="#" kode="{{$sen->id}}" class="btn btn-danger hapus">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</panel>
		</div>

		<div class="col-sm-6">
			<panel class="panel-primary">
				<div class="panel-heading">
					<p>Selasa</p>
				</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td>Jam Ke -</td>
								<td>Jam</td>
								<td>ID Guru</td>
								<td>Mapel</td>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$selasa=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
									->where('hari','=','Selasa')
									->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
									->get();
							?>
							@foreach($selasa as $sel)
							<tr>
								<td>{{$sel->jam_ke}}</td>
								<td>{{$sel->dari_jam.' - '.$sel->sampai_jam}}</td>
								<?php
									$mengajar=DB::table('mengajar')->where('id_guru','=',$sel->id_guru)
									->first();
								?>
								<td>{{$sel->id_guru}}</td>
								<td>{{$mengajar->kd_mapel}}</td>
								<td>
									<a href="#" kode="{{$sel->id}}" class="btn btn-danger hapus">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</panel>
		</div>

		<div class="col-sm-6">
			<panel class="panel-primary">
				<div class="panel-heading">
					<p>Rabu</p>
				</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td>Jam Ke -</td>
								<td>Jam</td>
								<td>ID Guru</td>
								<td>Mapel</td>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$rabu=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
									->where('hari','=','Rabu')
									->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
									->get();
							?>
							@foreach($rabu as $rab)
							<tr>
								<td>{{$rab->jam_ke}}</td>
								<td>{{$rab->dari_jam.' - '.$rab->sampai_jam}}</td>
								<?php
									$mengajar=DB::table('mengajar')->where('id_guru','=',$rab->id_guru)
									->first();
								?>
								<td>{{$rab->id_guru}}</td>
								<td>{{$mengajar->kd_mapel}}</td>
								<td>
									<a href="#" kode="{{$rab->id}}" class="btn btn-danger hapus">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</panel>
		</div>

		<div class="col-sm-6">
			<panel class="panel-primary">
				<div class="panel-heading">
					<p>Kamis</p>
				</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td>Jam Ke -</td>
								<td>Jam</td>
								<td>ID Guru</td>
								<td>Mapel</td>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$kamis=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
									->where('hari','=','Kamis')
									->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
									->get();
							?>
							@foreach($kamis as $kam)
							<tr>
								<td>{{$kam->jam_ke}}</td>
								<td>{{$kam->dari_jam.' - '.$kam->sampai_jam}}</td>
								<?php
									$mengajar=DB::table('mengajar')->where('id_guru','=',$kam->id_guru)
									->first();
								?>
								<td>{{$kam->id_guru}}</td>
								<td>{{$mengajar->kd_mapel}}</td>
								<td>
									<a href="#" kode="{{$kam->id}}" class="btn btn-danger hapus">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</panel>
		</div>

		<div class="col-sm-6">
			<panel class="panel-primary">
				<div class="panel-heading">
					<p>Jumat</p>
				</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td>Jam Ke -</td>
								<td>Jam</td>
								<td>ID Guru</td>
								<td>Mapel</td>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$jumat=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
									->where('hari','=','Jumat')
									->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
									->get();
							?>
							@foreach($jumat as $jum)
							<tr>
								<td>{{$jum->jam_ke}}</td>
								<td>{{$jum->dari_jam.' - '.$jum->sampai_jam}}</td>
								<?php
									$mengajar=DB::table('mengajar')->where('id_guru','=',$jum->id_guru)
									->first();
								?>
								<td>{{$jum->id_guru}}</td>
								<td>{{$mengajar->kd_mapel}}</td>
								<td>
									<a href="#" kode="{{$jum->id}}" class="btn btn-danger hapus">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</panel>
		</div>

		<div class="col-sm-6">
			<panel class="panel-primary">
				<div class="panel-heading">
					<p>Sabtu</p>
				</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td>Jam Ke -</td>
								<td>Jam</td>
								<td>ID Guru</td>
								<td>Mapel</td>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sabtu=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
									->where('hari','=','Sabtu')
									->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
									->get();
							?>
							@foreach($sabtu as $sab)
							<tr>
								<td>{{$sab->jam_ke}}</td>
								<td>{{$sab->dari_jam.' - '.$sab->sampai_jam}}</td>
								<?php
									$mengajar=DB::table('mengajar')->where('id_guru','=',$sab->id_guru)
									->first();
								?>
								<td>{{$sab->id_guru}}</td>
								<td>{{$mengajar->kd_mapel}}</td>
								<td>
									<a href="#" kode="{{$sab->id}}" class="btn btn-danger hapus">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</panel>
		</div>
	</div>


	<!-- Modal -->
  	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
      		<div class="modal-content">
        		<div class="modal-header">
	          		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          		<h4 class="modal-title">Input Jadwal # Kelas : {{$rombel->kd_rombel}}</h4>
	        	</div>
	        	<div class="modal-body">
	        		<div id="pesan"></div>


	        		<div id="loading" style="display:none;">
						<div class="alert alert-info"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</div>
					</div>


	          		<div class="form-horizontal" style="padding:10px;">
	          			<div class="form-group">
	          				<label for="">Hari</label>
	          				<input type="hidden" id="rombel" value="{{$rombel->kd_rombel}}">
	          				<select name="hari" id="hari" class="form-control">
	          					<option></option>
	          					<option value="Senin">Senin</option>
	          					<option value="Selasa">Selasa</option>
	          					<option value="Rabu">Rabu</option>
	          					<option value="Kamis">Kamis</option>
	          					<option value="Jumat">Jumat</option>
	          					<option value="Sabtu">Sabtu</option>
	          				</select>
	          			</div>

	          			<div class="row">
	          				<div class="col-sm-4">
	          					<div class="form-group">
			          				<label for="">Jam Ke</label>
			          				<select name="jam" id="jam" class="form-control">
			          					<option value=""></option>
			          				</select>
			          			</div>
	          				</div>

	          				<div class="col-sm-3" style="margin-left:25px;">
	          					<div class="form-group">
			          				<label for="">&nbsp;</label>
			          				<input class="form-control" id="dari" readonly="readonly">
			          			</div>
	          				</div>

	          				<div class="col-sm-3" style="margin-left:25px;">
	          					<div class="form-group">
			          				<label for="">&nbsp;</label>
			          				<input id="sampai" readonly="readonly" class="form-control">
			          			</div>
	          				</div>
	          			</div>

	          			<div class="form-group">
	          				<label for="">Mata Pelajaran</label>
	          				<select name="mapel" id="mapel" class="form-control">
	          					<option>--Pilih Mata Pelajaran--</option>
	          					@foreach($mapel as $m)
	          						<option value="{{$m->kd_mapel}}">{{$m->nm_mapel}}</option>
	          					@endforeach
	          				</select>
	          			</div>

	          			<div class="form-group">
	          				<label for="">Guru</label>
	          				<select name="guru" id="guru" class="form-control">
	          					<option value=""></option>
	          				</select>
	          			</div>
	          		</div>
	        	</div>
	        	<div class="modal-footer">
	          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	          		<button type="button" id="simpan" class="btn btn-primary">Simpan</button>
	        	</div>
	      	</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <!-- Modal -->
  	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
      		<div class="modal-content">
        		<div class="modal-header">
	          		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          		<h4 class="modal-title">Konfirmasi</h4>
	        	</div>
	        	<div class="modal-body">
	        		<div id="pesanhapus"></div>


	        		<div id="loadinghapus" style="display:none;">
						<div class="alert alert-info"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</div>
					</div>

					<input type="text" id="idhapus">
	        	</div>
	        	<div class="modal-footer">
	          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	          		<button type="button" id="konfirmasi" class="btn btn-danger">Hapus</button>
	        	</div>
	      	</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <script>
  	$(function(){

  		$(".hapus").click(function(){
  			var kode=$(this).attr("kode");

  			$("#idhapus").val(kode);
  			$("#myModal2").modal("show");
  		});

  		$("#konfirmasi").click(function(){
  			var kode=$("#idhapus").val();

  			$.ajax({
  				url:"{{URL::to('admin/hapus_jadwal')}}",
  				type:"POST",
  				data:"kode="+kode,
  				cache:false,
  				beforeSend:function(){
  					$("#loadinghapus").show();
  				},
  				success:function(html){
  					$("#loadinghapus").hide();
  					$("#pesanhapus").html("<div class='alert alert-success'>Data Berhasil dihapus</div>");
  					location.reload();
  				}
  			});
  		});

  		$("#hari").click(function(){
  			var rombel=$("#rombel").val();
  			var hari=$("#hari").val();

  			$.ajax({
  				url:"{{URL::to('admin/cari_jam_jadwal')}}",
  				type:"GET",
  				data:"rombel="+rombel+"&hari="+hari,
  				cache:false,
  				beforeSend:function(html){
  					$("#loading").show();
  				},
  				success:function(html){
  					$("#loading").hide();
  					$("#jam").html(html);
  				}
  			});
  		});

  		$("#jam").click(function(){
  			var jam=$("#jam").val();

  			$.ajax({
  				url:"{{URL::to('admin/get_jam')}}",
  				type:"GET",
  				data:"jam="+jam,
  				cache:false,
  				beforeSend:function(html){
  					$("#loading").show();
  				},
  				success:function(msg){
  					$("#loading").hide();
  					var data=msg.split("|");

  					$("#dari").val(data[0]);
  					$("#sampai").val(data[1]);
  				}
  			});
  		});

  		$("#mapel").click(function(){
  			var mapel=$("#mapel").val();

  			$.ajax({
  				url:"{{URL::to('admin/jadwal_get_guru')}}",
  				type:"GET",
  				data:"mapel="+mapel,
  				cache:false,
  				beforeSend:function(){
  					$("#loading").show();
  				},
  				success:function(html){
  					$("#loading").hide();
  					$("#guru").html(html);
  				}
  			})
  		});

  		$("#simpan").click(function(){
  			var hari=$("#hari").val();
  			var guru=$("#guru").val();
  			var rombel=$("#rombel").val();
  			var jam=$("#jam").val();
				var mapel=$("#mapel").val();

  			$.ajax({
  				url:"{{URL::to('admin/simpan_jadwal')}}",
  				type:"POST",
  				data:"hari="+hari+"&guru="+guru+"&rombel="+rombel+"&jam="+jam+"&mapel="+mapel,
  				cache:false,
  				beforeSend:function(){
  					$("#loading").show();
  				},
  				success:function(html){
  					if(html=="error"){
  						$("#loading").hide();
  						$("#pesan").html("<div class='alert alert-danger'>Jam ini sudah digunakan</div>");
  					}else if(html=="error2"){
  						$("#loading").hide();
  						$("#pesan").html("<div class='alert alert-danger'>Guru ini sudah mengajar di kelas lain</div>");
  					}else{
  						$("#loading").hide();
	  					$("#myModal").modal("hide");
	  					location.reload();
  					}
  				}
  			});
  		});
  	});
  </script>
@stop
