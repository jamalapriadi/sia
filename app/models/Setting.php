<?php
class Setting extends Eloquent{
	protected $table="setting";

	public $timestamps=false;

	public static $rules=[
		'nama'=>'required',
		'alamat'=>'required',
		'kabupaten'=>'required',
		'telp'=>'required',
		'fax'=>'required',
		'nip'=>'required',
		'tahun'=>'required',
		'semester'=>'required'
	];

	public static $pesan=[
		'nama.required'=>'Nama Harus diisi',
		'alamat.required'=>'Alamat harus diisi',
		'kabupaten.required'=>'Kabupaten harus diisi',
		'telp.required'=>'Telp harus diisi',
		'fax.required'=>'Fax harus diisi',
		'nip.required'=>'Nip harus diisi',
		'tahun.required'=>'Tahun harus diisi',
		'semester.required'=>'Semester harus diisi'
	];
}