<?php
class Rombel extends Eloquent{
	protected $table="rombel";
	protected $primaryKey="kd_rombel";

	public $timestamps=false;

	public static $rules=[
		'kelas'=>'required',
		'tahun'=>'required',
		'nip'=>'required'
	];

	public static $pesan=[
		'kelas.required'=>'Kelas Harus diisi',
		'tahun.required'=>'Tahun harus diisi',
		'nip.required'=>'NIP harus diisi'
	];

	public function guru(){
		return $this->belongsTo('Guru','id_wali');
	}
}