<?php
class Berita extends Eloquent{
	protected $table="berita";
	protected $primaryKey="id_berita";

	public static $rules=[
		'kategori'=>'required',
		'judul'=>'required',
		'isi'=>'required'
	];

	public static $pesan=[
		'kategori.required'=>'Kategori harus diisi',
		'judul.required'=>'Judul harus diisi',
		'isi.required'=>'Isi berita harus diisi'
	];

	public function kategori(){
		return $this->belongsTo('Kategori','id_kategori');
	}
}