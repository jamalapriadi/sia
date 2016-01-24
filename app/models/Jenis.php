<?php
class Jenis extends Eloquent{
  protected $table="jenis_nilai";
  protected $primaryKey="kd_jenis";

  public $timestamps=false;

  public static $rules=[
    'kode'=>'required',
    'nama'=>'required'
  ];

  public static $pesan=[
    'kode.required'=>'Kode harus diisi',
    'nama.required'=>'Nama harus diisi'
  ];
}
