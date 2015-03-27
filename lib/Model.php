<?php
class Model extends Core {
	// Default properties
	public $id;
	public function __construct() {
	}
	public function GetDB() {
		return Database::getInstance();
	}
	public function Load($id) {
		$db = $this->GetDB();
		$query = 'SELECT * FROM ' . String::Table ( $this->Name () ) . ' WHERE id=:id';
		$stm = $db->con->prepare ( $query );
		$params = array (
				':id' => $id 
		);
		if ($stm->execute ( $params )) {
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
		$db = $this->GetDB();
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
		
		$db = $this->GetDB();
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
		$db = $this->GetDB();
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
		$db = $this->GetDB();
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
	/**
	 * Checks if an ID with given parameters exists in database
	 * $check contains values passed to the WHERE statement
	 *
	 * @param array $check
	 *        	:: 'field' = 'value'
	 * @return unknown|boolean
	 */
	public function Exists($check) {
		$db = $this->GetDB();
		$query = 'SELECT id FROM ';
		$query .= String::Table ( $this->Name () );
		$query .= ' WHERE ';
		$first = true;
		$params = array ();
		foreach ( $check as $k => $v ) {
			if ($first != true) {
				$query .= ' AND ';
			}
			$a = ':' . $k; // Placeholder
			$query .= $k . '=' . $a; // Assign 'field'='value'
			$params [$a] = $v; // Assign parameter for execution
			$first = false;
		}
		$stm = $db->con->prepare ( $query );
		Log::Add ( 'Query', $query );
		Log::Add ( 'Params', $params );
		if ($stm->execute ( $params )) {
			if ($stm->rowCount () != 0) {
				Log::Add ( 'DB Success', $this->Name () . ' does exist' );
				$id = $stm->fetchColumn ();
				return $id;
			} else {
				Log::Add ( 'DB Success', $this->Name () . ' does not exist' );
				return false;
			}
		} else {
			Log::Add ( 'DB Failure', $this->Name () . ' error in query' );
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