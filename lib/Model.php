<?php
abstract class Model {
	public $name;
	public $table_name;
	public $properties = array(
			'id'
	);
	
	public function __construct() {
		$this->properties = array_flip($this->properties);
	} 
	
	public function Validate() {
		return false;
	}
	public function Insert() {
		$this->properties['id'] = 0;
		$query = 'INSERT INTO '. $this->table_name .'('. implode(',',$this->properties).') VALUES (?'.str_repeat(',?',count($this->properties)-1).')';
		$db->Statement($query);
		$db->BindParameters($this->values);
		$db->Execute();
	}
}