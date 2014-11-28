<?php
class Model extends Core {
	public $properties;
	public $db;
	public function __construct() {
		$this->db = new Database ();
		$this->DefineProperties ();
	}
	public function Validate($property, $value) {
		return false;
	}
	/**
	 * Fetches the properties of the model from the database
	 */
	public function DefineProperties() {
		$query = 'DESCRIBE ' . strtolower ( $this->Name () ) . 's';
		$this->db->query ( $query );
		$rows = $this->db->Result ();
		foreach ( $rows as $row ) {
			$this->properties [$row [0]] = null;
		}
	}
	/**
	 * Sets properties to the model using an array
	 *
	 * @param array $array        	
	 */
	public function SetProperties($array) {
		$count = 0;
		foreach ( $this->properties as $k => $v ) {
			$this->properties [$k] = $array [$count];
			$count ++;
		}
	}
	/**
	 * Loads one model from the database
	 *
	 * @param integer $id        	
	 */
	public function Load($id) {
		$query = 'SELECT ' . $this->TableCollumns () . ' FROM ' . $this->Name () . 's WHERE id = %d';
		$query = sprintf ( $query, $id );
		if ($this->db->Query ( $query )) {
			$result = $this->db->Result ();
			$this->SetProperties ( $result [0] );
		} else {
			$this->SetFlash ( 'DB Warning', MSG_DB_ID_NOT_FOUND );
		}
	}
	public function TableCollumns() {
		$out = '';
		foreach ( $this->properties as $k => $v ) {
			$out .= $k . ',';
		}
		return substr ( $out, 0, strlen ( $out ) - 1 );
	}
	// not used yet
	public function Insert() {
		$this->properties ['id'] = 0;
		$query = 'INSERT INTO ' . $this->table_name . '(' . $this->TableCollumns () . ') VALUES (?' . str_repeat ( ',?', count ( $this->properties ) - 1 ) . ')';
		$db->Statement ( $query );
		$db->BindParameters ( $this->values );
		$db->Execute ();
	}
}