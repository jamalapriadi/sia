@extends('template.index')

@section('content')
	<legend>Setting</legend>

	@if(Session::has('pesan'))
		{{Session::get('pesan')}}
	@endif

	{{Form::open(array('url'=>'admin/setting','method'=>'POST','class'=>'form-horizontal','files'=>true))}}
		<input type="hidden" name="id" value="{{$setting->id}}">
		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('nama','Nama Sekolah',$setting->nm_sekolah,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('npsn','NPSN',$setting->npsn,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('nss','NSS',$setting->nss,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('alamat','Alamat Sekolah',$setting->alamat_sekolah,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('kabupaten','Kabupaten',$setting->kabupaten,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('kecamatan','Kecamatan',$setting->kecamatan,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('status','Status Sekolah',$setting->status_sekolah,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('mutu','Status Mutu',$setting->status_mutu,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('akreditasi','Akreditasi',$setting->akreditasi,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('telp','Telp Sekolah',$setting->telp_sekolah,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('fax','Fax',$setting->fax_sekolah,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('nip','Nip Kepala Sekolah',$setting->nip_kepsek,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->text('mulai','Mulai Tahun Ajaran',$setting->dari_tahun,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
				->text('sampai','Berakhir Tahun Ajaran',$setting->sampai_tahun,$errors)}}

		{{Bootstrap::horizontal('col-sm-4','col-sm-2')
			->select('semester','Semester',[$setting->semester=>$setting->semester,'1'=>'1','2'=>'2'],'',$errors)}}

		<div class="form-group">
			{{Form::label('logo','Logo Sekolah',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				{{HTML::image('uploads/logo/'.$setting->logo_sekolah,'',array('style'=>'width:100px'))}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<input type="file" name="logo" class="form-control">
			</div>
		</div>

		<div class="form-group well">
			{{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-save"></i>
					Simpan
				</button>
			</div>
		</div>
	{{Form::close()}}
@stop
