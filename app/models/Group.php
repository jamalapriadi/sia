<?php
class Group extends Eloquent{
  protected $table="groups";

  public function user_group(){
    return $this->belongsTo('User_group','users_groups.group_id');
  }
}
