<?php
class GroupController extends BaseController{
  public function index(){
    $group=Group::all();
    return View::make('group.index')
      ->with('group',$group);
  }

  public function aktif(){
    if(Request::ajax()){
      $group=Input::get('group');

      $cekgroup=DB::table('users_groups')
        ->where('group_id','=',$group)
        ->get();
      $counter=0;
      foreach($cekgroup as $row){
        $user=User::find($row->user_id);
        $user->activated=1;
        $user->activated_at=date('Y-m-d H:i:s');
        $user->save();

        $counter++;
      }
      Session::flash('pesan',"<div class='alert alert-info'>
      Data User berhasil di aktifkan sebanyak ".$counter." User</div>");
    }
  }

  public function nonaktif(){
    if(Request::ajax()){
      $group=Input::get('group');

      $cekgroup=DB::table('users_groups')
      ->where('group_id','=',$group)
      ->get();
      $counter=0;
      foreach($cekgroup as $row){
        $user=User::find($row->user_id);
        $user->activated=0;
        $user->activated_at=date('Y-m-d H:i:s');
        $user->save();

        $counter++;
      }
      Session::flash('pesan',"<div class='alert alert-info'>
      Data User berhasil di non-aktifkan sebanyak ".$counter." User</div>");
    }
  }
}
