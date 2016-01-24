@extends('web.template')

@section('content')
	<legend>Data Siswa</legend>

	<div class="form-horizontal">
		<div class="form-group">
			{{Form::label('kelas','Kelas',array('class'=>'col-lg-3 control-label'))}}
			<div class="col-lg-6">
				<select name="kelas" class="input-sm form-control" id="kelas">
					<option></option>
					@foreach($kelas as $kelas)
						<option value="{{$kelas->kd_kelas}}">{{$kelas->kd_kelas}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			{{Form::label('tahun','Tahun Ajaran',array('class'=>'col-lg-3 control-label'))}}
			<div class="col-lg-6">
				<select name="tahun" class="input-sm form-control" id="tahun">
					<option></option>
				</select>
			</div>
		</div>
	</div>

	<div id="tampil"></div>

	<script>
		$(function(){
			$("#kelas").click(function(){
				var kelas=$("#kelas").val();

				$.ajax({
					url:"{{URL::to('get_kelas')}}",
					type:"POST",
					data:"kelas="+kelas,
					cache:false,
					success:function(html){
						$("#tahun").html(html)
					}
				})
			})

			$("#tahun").click(function(){
				var kelas=$("#kelas").val();
				var tahun=$("#tahun").val();

				$.ajax({
					url:"{{URL::to('tampil_rombel')}}",
					type:"POST",
					data:"kelas="+kelas+"&tahun="+tahun,
					cache:false,
					success:function(html){
						$("#tampil").html(html);
					}
				})
			})
		})
	</script>
@stop