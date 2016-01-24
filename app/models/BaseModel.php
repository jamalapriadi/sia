<?php
class BaseModel extends \Eloquent{
	public static $rules=[];

	public function updateRules(){
		$rules=static::$rules;

		foreach($rules as $field=>$rule){
			$rules[$field]=str_replace(':id',$this->getKey(), $rule);
		}

		return $rules;
	}
}