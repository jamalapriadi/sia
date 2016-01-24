<?php
class Kkm extends \BaseModel{
	protected $table="kkm";

	public static $rules=[
		'tahun'=>'required',
		'mapel'=>'required',
		'nilai'=>'required'
	];

	public static $pesan=[
		'tahun.required'=>'Tahun Ajaran harus diisi',
		'mapel.required'=>'Mata Pelajaran harus diisi',
		'nilai.required'=>'Nilai KKM harus diisi'
	];

	public function mapel(){
		return $this->belongsTo('Mapel','kd_mapel');
	}
}