<?php
class SentrySeeder extends Seeder{
	public function run(){
		DB::table('users_groups')->delete();
		DB::table('groups')->delete();
		DB::table('users')->delete();
		DB::table('throttle')->delete();

		try{
			//membuat group admin
			$group=Sentry::createGroup(array(
					'name'			=>'admin',
					'permissions'	=>array(
						'admin'=>1,
					)
				
			));

			//membuat group guru
			$guru=Sentry::createGroup(array(
				'name'			=>'guru',
				'permissions'	=>array(
					'guru'	=>1,
				)
			));

			//membuat group siswa
			$siswa=Sentry::createGroup(array(
				'name'			=>'siswa',
				'permissions'	=>array(
					'siswa'	=>1,
				)
			));			
		}catch(Cartalyst\Sentry\Groups\NameRequiredException $e){
			echo "Nama Group harus diisi";
		}catch(Cartalyst\Sentry\Groups\GroupExistsException $e){
			echo "Group Sudah Ada";
		}

		try{
			//membuat admin baru
			$admin=Sentry::register(array(
				'password'=>'admin123',
				'username'=>'Admin'
			),true);

			//cari group admin
			$adminGroup=Sentry::findGroupByName('admin');

			//masukan user ke group admin
			$admin->addGroup($adminGroup);

		}catch(Cartalyst\Sentry\Users\LoginRequiredException $e){
			echo "Field login harus diisi";
		}catch(Cartalyst\Sentry\Users\PasswordRequiredException $e){
			echo "Password harus diisi";
		}catch(Cartalyst\Sentry\Users\UserExistsException $e){
			echo "User dengan akun ini sudah ada";
		}catch(Cartalyst\Sentry\Groups\GroupNotFoundException $e){
			echo "Group tidak ada";
		}
	}

}