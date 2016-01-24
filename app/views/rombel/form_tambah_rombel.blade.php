{{Form::open(array('url'=>'admin/simpan_rombel','method'=>'post','class'=>'form-horizontal'))}}
	{{Bootstrap::horizontal('col-sm-8','col-sm-3')
		->text('nis','NIS','',$errors,array('autofocus'))}}

	{{Bootstrap::horizontal('col-sm-8','col-sm-3')
		->text('nama','Nama','',$errors,array('readonly'=>'readonly'))}}

	{{Bootstrap::horizontal('col-sm-8','col-sm-3')
		->text('jk','JK','',$errors,array('readonly'=>'readonly'))}}
{{Form::close()}}