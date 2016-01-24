<?php
class Mapel extends Eloquent{
	protected $table="mapel";
	protected $primaryKey="kd_mapel";

	public $timestamps=false;

	public function mengajar(){
		return $this->hasOne('mengajar','kd_mapel');
	}

	public function kkm(){
		return $this->hasOne('Kkm','kd_mapel');
	}
}