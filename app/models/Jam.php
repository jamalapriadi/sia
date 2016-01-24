<?php
class Jam extends Eloquent{
	protected $table="jam_pelajaran";
	protected $primaryKey="jam_ke";

	public $timestamps=false;

	public static $rules=[
		'jam'=>'required',
		'dari'=>'required',
		'sampai'=>'required'
	];

	public static $pesan=[
		'jam.required'=>'Jam harus diisi',
		'dari.required'=>'Dari jam harus diisi',
		'sampai.required'=>'Sampai Jam harus diisi'
	];
}