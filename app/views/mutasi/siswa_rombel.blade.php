@if($siswa->count()>0)
	{{Form::open(array('url'=>'admin/proses_mutasi','method'=>'post'))}}
	<input type="hidden" name="daritahun" value="{{$awal}}">

	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th style="width:5%;"><input type='checkbox' id='selectall'></th>
				<th>No.</th>
				<th>Nis</th>
				<th>Nama</th>
				<th>Jk</th>
			</tr>
		</thead>
		<?php $no=0; ?>
		@foreach($siswa->get() as $row)
			<?php $no++; ?>
			<tr>
				<td style="width:5%;"><input type='checkbox' name='pilih[]' value="{{$row->nis}}" class='checkbox1'></td>
				<td>{{$no}}</td>
				<td>{{$row->nis}}</td>
				<td>{{$row->nm_siswa}}</td>
				<td>{{$row->jk}}</td>
			</tr>
		@endforeach
	</table>

	<div class="well">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					{{Form::label('kelas','Kelas')}}
					<select name="kelas" id="" class="form-control">
						@foreach($lain as $row)
							<option value="{{$row->kd_kelas}}">{{$row->kd_kelas}}</option>
						@endforeach
					</select>
				</div>	
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					{{Form::label('tahun','Tahun Ajaran')}}
					<input type="text" value="{{$setting->dari_tahun.'-'.$setting->sampai_tahun}}" readonly="readonly" name="tahun" class="form-control" required="required">
				</div>	
			</div>

			<div class="col-sm-3">
				<button class="btn btn-primary" style="margin-top:20px;">
					<i class="glyphicon glyphicon-saved"></i>
					Simpan
				</button>
			</div>
		</div>
	</div>
	{{Form::close()}}
@else
	<div class="alert alert-danger">Data Siswa tidak ditemukan</div>
@endif