<?php
/**
 * Provides a connector to the database
 * setup in config or provided as an options array
 * @author Ivan
 *
 */
class Database {
	public $self;
	private $result;
	private $statement;
	private $StatementTypes = array (
			'i',
			's',
			'd',
			'b' 
	);
	/**
	 * Constructor for the Database Handler Class
	 * 
	 * @param array $options:
	 *        	Options array containing host, user, pass, db
	 */
	public function __construct($options = false) {
		if ($options != false) {
			$this->self = new mysqli ( $options ['host'], $options ['user'], $options ['pass'], $options ['db'] );
		} else {
			$this->self = new mysqli ( DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT );
		}
	}
	public function Query($query = false) {
		$this->result = $this->self->query ( $query );
		return $this->result->num_rows;
	}
	public function Statement($query) {
		$this->statement = $this->self->prepare ( $query );
	}
	public function Execute() {
		$this->statement->execute ();
		$this->result = $this->statement->get_result ();
		$this->statement->close ();
	}
	/**
	 * Binds an array to a prepared statement    	
	 * @param array $parameters        	
	 */
	public function BindParameters($parameters) {
		$datatypes = $this->GetArrayDatatypes($parameters);
		$types = '';
		$values = array ();
		$i = 0;
		foreach ( str_split ( $datatypes ) as $type ) {
			if (! in_array ( $type, $this->StatementTypes )) {
				die ( 'ERROR: wrong datatype in MySQL statement' );
			} else {
				$types .= $type;
				$values [] = &$parameters [$i];
			}
			$i ++;
		}
		call_user_func_array ( array (
				$this->statement,
				'bind_param' 
		), array_merge ( array (
				$types 
		), $values ) );
	}
	public function GetDatatype($var) {
		$texttype = gettype ( $var );
		switch ($texttype) {
			case 'boolean' :
			case 'integer' :
				return 'i';
				break;
			case 'double' :
				return 'd';
				break;
			case 'string' :
				return 's';
				break;
		}
	}
	public function GetArrayDatatypes($array) {
		$out = '';
		foreach ($array as $item) {
			$out .= $this->GetDatatype($item);
		}
		return $out;
	}
	public function GetData() {
		return $this->result->fetch_all ();
	}
	/**
	 * Resets the result and statement and frees memory;
	 */
	public function Reset() {
		$this->result->free ();
		unset ( $this->result );
		unset ( $this->statement );
	}
	/**
	 * Closes the DB connection when class is destroyed
	 */
	public function __destruct() {
		$this->Reset ();
		$this->self->close ();
	}
}