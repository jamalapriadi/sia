@extends('template.index')

@section('content')
	<div class="well">
		<legend>Tambah Rombel</legend>

		@if(Session::has('pesan'))
			{{Session::get('pesan')}}
		@endif 
		
		{{Form::model($rombel,array('url'=>route('admin.rombel.update',['rombel'=>$rombel->kd_rombel]),'method'=>'PUT','class'=>'form-horizontal'))}}
			<div class="form-group">	
				{{Form::label('kelas','Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="kelas" class="form-control" readonly="readonly">
						<option value="{{$rombel->kd_kelas}}">{{$rombel->kd_kelas}}</option>
						@foreach($kelas as $kelas)
							<option value="{{$kelas->kd_kelas}}">{{$kelas->kd_kelas}}</option>
						@endforeach
					</select>
				</div>
				{{$errors->first('kelas')}}
			</div>

			<div class="form-group">
				{{Form::label('tahun','Tahun Ajaran',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					{{Form::text('tahun',$rombel->thn_ajaran,array('class'=>'form-control','readonly'=>'readonly'))}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('nip','Wali Kelas',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<select name="nip" class="form-control">
						@foreach($guru as $guru)
							<option value="{{$guru->id}}" @if($rombel->id_wali==$guru->id) selected='selected' @endif>{{$guru->nm_guru}}</option>
						@endforeach
					</select>
				</div>
				{{$errors->first('nip')}}
			</div>

			<hr>
			<div class="form-group">
				{{Form::label('','',array('class'=>'col-lg-2 control-label'))}}
				<div class="col-lg-4">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-saved"></i>
						Update
					</button>

					<a href="{{URL::to('admin/rombel')}}" class="btn btn-default">Kembali</a>
				</div>
			</div>
		{{Form::close()}}
	</div>
@stop