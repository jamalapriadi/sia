<?php
class Kategori extends Eloquent{
	protected $table="kategori";
	protected $primaryKey="id_kategori";

	public static $rules=[
		'nama'=>'required'
	];

	public static $pesan=['nama.required'=>'Nama Kategori harus diisi'];

	public function berita(){
		return $this->hasOne('berita','id_kategori');
	}
}