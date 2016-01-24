<?php
class Usergroup extends Eloquent{
  protected $table="users_groups";

  public function user(){
    return $this->hasOne('User','users.id');
  }

  public function group(){
    return $this->hasOne('Group','groups.id');
  }
}
