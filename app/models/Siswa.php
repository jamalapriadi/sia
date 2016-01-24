<?php
class Siswa extends \BaseModel{
	protected $table="siswa";

	public $timestamps=false;

	public static $rules=[
		'nis'=>'required|unique:siswa,nis,:id',
		'nisn'=>'unique:siswa,nisn,:id',
		'nama'=>'required',
		'jk'=>'required',
		'tempat'=>'required',
		'tanggal'=>'required',
		'agama'=>'required',
		'ayah'=>'required',
		'ibu'=>'required',
		'alamat'=>'required',
		'tahun'=>'required',
		'email'=>'required|unique:users,username,:id'
	];

	public static $pesan=[
		'nis.required'=>'NIS harus diisi',
		'nis.unique'=>'NIS sudah digunakan',
		'nisn.unique'=>'NISN sudah ada',
		'nama.required'=>'Nama harus diisi',
		'jk.required'=>'Jenis Kelamin harus diisi',
		'tempat.required'=>'Tempat Lahir harus diisi',
		'tanggal.required'=>'Tanggal Lahir harus diisi',
		'agama.required'=>'Agama harus diisi',
		'ayah.required'=>'Nama ayah harus diisi',
		'ibu.required'=>'Nama Ibu harus diisi',
		'alamat.required'=>'Alamat harus diisi',
		'tahun.required'=>'Tahun harus diisi',
		'email.required'=>'Email harus diisi'
	];

	public function detail(){
		return $this->hasOne('detail','nis');
	}
}
