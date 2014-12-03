<?php
class Model extends Core {
	// Default properties
	public $id;
	public $created;
	public $modified;
	public function __construct() {
	}
	public function Load($id) {
		$db = Database::getInstance ();
		$query = 'SELECT * FROM ' . String::Lower ( $this->Name () ) . 's WHERE id=:id';
		$stm = $db->con->prepare ( $query );
		$params = array (
				':id' => $id 
		);
		if ($stm->execute ()) {
			Log::Add ( 'DB Success', $this->Name () . ' was found' );
			foreach ( $stm->fetch ( PDO::FETCH_NAMED ) as $k => $v ) {
				$this->$k = $v;
			}
			return true;
		} else {
			Log::Add ( 'DB Failure', $this->Name () . ' was not found' );
			return false;
		}
	}
	public function Save() {
		$db = Database::getInstance ();
		$query = $this->QueryUpdate ();
		$stm = $db->con->prepare ( $query );
		foreach ( $this as $k => &$v ) {
			$key = ':' . $k;
			$stm->bindParam ( $key, $v );
		}
		if ($stm->execute ()) {
			Log::Add ( 'DB Success', $this->Name () . ' was saved' );
			return true;
		} else {
			Log::Add ( 'DB Failure', $this->Name () . ' was not saved' );
			return false;
		}
	}
	public function Create() {
		$this->id = null;
		$this->created = 0;
		$this->modified = 0;
		
		$db = Database::getInstance ();
		$query = $this->QueryInsert ();
		$stm = $db->con->prepare ( $query );
		foreach ( $this as $k => &$v ) {
			$key = ':' . $k;
			$stm->bindParam ( $key, $v );
		}
		if ($stm->execute ()) {
			Log::Add ( 'DB Success', $this->Name () . ' was created' );
			return true;
		} else {
			Log::Add ( 'DB Failure', $this->Name () . ' was not created' );
			return false;
		}
	}
	public function Delete($id) {
		$db = Database::getInstance ();
		$query = 'DELETE FROM ';
		$query .= String::Table ( $this->Name () );
		$query .= ' WHERE id=:id';
		$stm = $db->con->prepare ( $query );
		$params = array (
				':id' => $id 
		);
		if ($stm->execute ( $params )) {
			Log::Add ( 'DB Success', $this->Name () . ' record was deleted' );
			return true;
		} else {
			Log::Add ( 'DB Failure', $this->Name () . ' record was not deleted' );
			return false;
		}
	}
	public function All($start = false, $count = false) {
		$db = Database::getInstance ();
		$query = 'SELECT * FROM ';
		$query .= String::Table ( $this->Name () );
		if ($start != false && $count != false) {
			$query .= ' LIMIT ' . $start . ',' . $count;
		}
		$stm = $db->con->prepare ( $query );
		if ($stm->execute ()) {
			Log::Add ( 'DB Success', $this->Name () . ' list found' );
			return $stm->fetchAll ( PDO::FETCH_ASSOC );
		} else {
			Log::Add ( 'DB Failure', $this->Name () . ' list not found' );
			return false;
		}
	}
	public function Exists($field, $value) {
		$db = Database::getInstance ();
		$query = 'SELECT id FROM ';
		$query .= String::Table ( $this->Name () );
		$query .= ' WHERE ';
		$query .= $field;
		$query .= '=:value';
		$stm = $db->con->prepare ( $query );
		$params = array (
				':value' => $value 
		);
		if ($stm->execute($params)) {
			if ($stm->rowCount() <> 0) {
				Log::Add('DB Success',$this->Name() . ' does exist');
				return true;
			} else {
				Log::Add('DB Success',$this->Name() . ' does not exist');
				return false;
			}
		} else {
			Log::Add('DB Failure',$this->Name() . ' error in query');
			return false;
		}
	}
	private function QueryInsert() {
		$query = 'INSERT INTO ';
		$query .= String::Table ( $this->Name () );
		$query .= ' (';
		foreach ( $this as $k => $v ) {
			$query .= $k . ',';
		}
		$query = String::TrimLast ( $query );
		$query .= ') VALUES (';
		foreach ( $this as $k => $v ) {
			$query .= ':' . $k . ',';
		}
		$query = String::TrimLast ( $query );
		$query .= ')';
		return $query;
	}
	private function QueryUpdate() {
		$query = 'UPDATE ';
		$query .= String::Table ( $this->Name () );
		$query .= ' SET ';
		foreach ( $this as $k => $v ) {
			$query .= $k . ' = :' . $k . ',';
		}
		$query = String::TrimLast ( $query );
		$query .= ' WHERE id=';
		$query .= $this->id;
		return $query;
	}
}