<?php
class Guru extends \BaseModel{
	protected $table="guru";

	public $timestamps=false;

	public static $rules=[
		'id'=>'required|unique:guru,id,:id',
		'nip'=>'unique:guru,nip,:id',
		'nuptk'=>'unique:guru,nuptk,:id',
		'nama'=>'required',
		'tempat'=>'required',
		'tanggal'=>'required',
		'jk'=>'required',
		'pendidikan'=>'required',
		'tahun'=>'required',
		'mulai'=>'required',
		'email'=>'required|email|unique:guru,email,:id'
	];

	public static $pesan=[
		'id.required'=>'ID guru harus diisi',
		'id.unique'=>'ID sudah digunakan',
		'nip.unique'=>'NIP sudah ada',
		'nuptk.unique'=>'NUPTK sudah ada',
		'nama.required'=>'Nama harus diisi',
		'tempat.required'=>'Tempat Lahir harus diisi',
		'tanggal.required'=>'Tanggal Lahir harus diisi',
		'jk.required'=>'Jenis Kelamin harus diisi',
		'pendidikan.required'=>'Pendidikan harus diisi',
		'mulai.required'=>'Tgl Mulai kerja harus diisi',
		'email.required'=>'Email harus diisi',
		'email.unique'=>'Email sudah digunakan'
	];

	public function rombel(){
		return $this->hasOne('rombel','id_wali');
	}

	public function mengajar(){
		return $this->hasMany('mengajar','id_guru');
	}
}