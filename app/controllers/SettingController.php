<?php
class SettingController extends BaseController{
	public function index(){
		$setting=Setting::first();

		return View::make('setting.index')
			->with('setting',$setting);
	}

	public function simpan(){
		$validasi=Validator::make(Input::all(),Setting::$rules,Setting::$pesan);

		if($validasi->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validasi);
		}else{
			$cek=DB::table('setting')->count();

			if($cek>0){
				$id=Input::get('id');

				$setting=Setting::find($id);
				$setting->nm_sekolah=Input::get('nama');
				$setting->npsn=Input::get('npsn');
				$setting->nss=Input::get('nss');
				$setting->alamat_sekolah=Input::get('alamat');
				$setting->kabupaten=Input::get('kabupaten');
				$setting->kecamatan=Input::get('kecamatan');
				$setting->status_sekolah=Input::get('status');
				$setting->status_mutu=Input::get('mutu');
				$setting->akreditasi=Input::get('akreditasi');
				$setting->telp_sekolah=Input::get('telp');
				$setting->fax_sekolah=Input::get('fax');
				$setting->nip_kepsek=Input::get('nip');
				$setting->dari_tahun=Input::get('mulai');
				$setting->sampai_tahun=Input::get('sampai');
				$setting->semester=Input::get('semester');

				if(Input::hasFile('logo')){
					$file=Input::file('logo');
					$filename=str_random(5).'-'.$file->getClientOriginalName();
					$destinationPath='uploads/logo/';
					$file->move($destinationPath,$filename);


					if($setting->logo_sekolah){
						$fotolama=$setting->logo_sekolah;
						$filepath=public_path().DIRECTORY_SEPARATOR.'uploads/logo'.DIRECTORY_SEPARATOR.$setting->logo_sekolah;

						try{
							File::delete($filepath);
						}catch(FileNotFoundException $e){

						}
					}

					$setting->logo_sekolah=$filename;
				}
				$setting->save();

				Session::flash('pesan',"<div class='alert alert-info'>
					Data Berhasil diupdate</div>");
				return Redirect::back();
			}else{
				$setting->nm_sekolah=Input::get('nama');
				$setting->npsn=Input::get('npsn');
				$setting->nss=Input::get('nss');
				$setting->alamat_sekolah=Input::get('alamat');
				$setting->kabupaten=Input::get('kabupaten');
				$setting->kecamatan=Input::get('kecamatan');
				$setting->status_sekolah=Input::get('status');
				$setting->status_mutu=Input::get('mutu');
				$setting->akreditasi=Input::get('akreditasi');
				$setting->telp_sekolah=Input::get('telp');
				$setting->fax_sekolah=Input::get('fax');
				$setting->nip_kepsek=Input::get('nip');
				$setting->dari_tahun=Input::get('mulai');
				$setting->sampai_tahun=Input::get('sampai');
				$setting->semester=Input::get('semester');

				if(Input::hasFile('logo')){
					$file=Input::file('logo');
					$filename=str_random(5).'-'.$file->getClientOriginalName();
					$destinationPath='uploads/logo/';
					$file->move($destinationPath,$filename);
					$setting->logo_sekolah=$filename;
				}

				$setting->save();

				Session::flash('pesan',"<div class='alert alert-info'>
					Data Berhasil disimpan</div>");
				return Redirect::back();
			}
		}
	}
}

