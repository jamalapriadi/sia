<?php
class MapelSeeder extends Seeder{
  public function run(){
    DB::table('mapel')->delete();

    $data=array(
      array(
        'kd_mapel'=>'BI',
        'nm_mapel'=>'Bahasa Indonesia'
      ),
      array(
        'kd_mapel'=>'MTK',
        'nm_mapel'=>'Matematika'
      ),
      array(
        'kd_mapel'=>'Bing',
        'nm_mapel'=>'Bahasa Inggris'
      ),
      array(
        'kd_mapel'=>'PAI',
        'nm_mapel'=>'Pendidikan Agama Islam'
      ),
      array(
        'kd_mapel'=>'IPA',
        'nm_mapel'=>'Ilmu Pengetahuan Alam'
      ),
      array(
        'kd_mapel'=>'IPS',
        'nm_mapel'=>'Ilmu Pengetahuan Sejarah'
      ),
      array(
        'kd_mapel'=>'PKN',
        'nm_mapel'=>'Pendidikan Kewarganegaraan'
      ),
      array(
        'kd_mapel'=>'Penjas',
        'nm_mapel'=>'Pendidikan Jasmani dan Rohani'
      ),
      array(
        'kd_mapel'=>'BJ',
        'nm_mapel'=>'Bahasa Jawa'
      ),
      array(
        'kd_mapel'=>'TINKOM',
        'nm_mapel'=>'Teknologi Informasi dan Komunikasi'
      ),
      array(
        'kd_mapel'=>'Tabog',
        'nm_mapel'=>'Tata Boga'
      ),
      array(
        'kd_mapel'=>'Elektro',
        'nm_mapel'=>'Elektro'
      ),
      array(
        'kd_mapel'=>'Seni',
        'nm_mapel'=>'Seni'
      )
    );

    DB::table('mapel')->insert($data);
  }
}
