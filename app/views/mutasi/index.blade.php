@extends('template.index')

@section('content')
	<legend>Pindah Kelas</legend>

	<div class="well">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label for="">Kelas</label>
					<select name="kelasawal" id="kelasawal" class="form-control">
						<option>--Pilih Kelas--</option>
						@foreach($kelas as $row)
							<option value="{{$row->kd_kelas}}">{{$row->kd_kelas}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label for="">Tahun Ajaran</label>
					<input type="text" value="{{$setting->dari_tahun.'-'.$setting->sampai_tahun}}" id="tahunawal" name="tahun" class="form-control" readonly="readonly">
				</div>
			</div>
		</div>
	</div>
	
	<div id="loading" style="display:none;">
		<div class="alert alert-info"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</div>
	</div>

	<div id="data"></div>

	<div id="hasil"></div>

	<script>
		$(function(){
			var countChecked = function() {
			  var n = $( "input:checked.checkbox1" ).length;
			  $( "#hasil" ).text( n + (n === 1 ? " siswa" : " siswa") + " dipilih!" );
			};

			function loadData(){
				var awal=$("#kelasawal").val();
				var tahun=$("#tahunawal").val();

				$.ajax({
					url:"{{URL::to('admin/get_mutasi_siswa_rombel')}}",
					type:"GET",
					data:"awal="+awal+"&tahun="+tahun,
					cache:false,
					success:function(html){
						$("#data").html(html);
					}
				})
			}
			$("#kelasawal").click(function(){
				var awal=$("#kelasawal").val();

				$.ajax({
					url:"{{URL::to('admin/pindah_cari_kelas')}}",
					type:"GET",
					data:"awal="+awal,
					cache:false,
					beforeSend:function(html){
						$("#loading").show();
						$("#loading").fadeIn(2000);
					},
					success:function(html){
						$("#kelas").html(html);
						$("#loading").hide();
						loadData();
					}
				});
			});

			$( document ).on( "click", "#selectall", function() {
				$("input:checkbox").prop('checked', $(this).prop("checked"));
				countChecked();
			});

			$( document ).on( "click", ".checkbox1", function() {
				$(this).prop('checked', $(this).prop("checked"));
				countChecked();
			});
		});
	</script>
@stop