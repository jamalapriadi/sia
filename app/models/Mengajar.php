<?php
class Mengajar extends \BaseModel{
	protected $table="mengajar";

	public $timestamps=false;

	public static $rules=[
		'guru'=>'required',
		'mapel'=>'required'
	];

	public static $pesan=[
		'guru.required'=>'Guru harus diisi',
		'mapel.required'=>'Mapel harus diisi'
	];

	public function guru(){
		return $this->belongsTo('Guru','id_guru');
	}

	public function mapel(){
		return $this->belongsTo('Mapel','kd_mapel');
	}
}