<?php
class Detail extends Eloquent{
	protected $table="detail_rombel";
	protected $primaryKey=array('kd_rombel','nis');

	public $timestamps=false;

	public function siswa(){
		return $this->belongsTo('Siswa','nis');
	}
}
