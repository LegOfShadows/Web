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
	
	private $StatementTypes = array('i','s','d','b');
	/**
	 * Constructor for the Database Handler Class
	 * @param array $options: Options array containing host, user, pass, db
	 */
	public function __construct($options = false) {
		if ($options != false) {
			$this->self = new mysqli($options['host'],$options['user'],$options['pass'],$options['db']);
		} else {
			$this->self = new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE,DB_PORT);
		}
	}
	public function Query($query = false) {
		$this->result = $this->self->query($query);
		return $this->result->num_rows;
	}
	public function Statement($query) {
		$this->statement = $this->self->prepare($query);
	}
	public function Execute() {
		$this->statement->execute();
		$this->result = $this->statement->get_result();
		$this->statement->close();
	}
	/**
	 * 
	 * @param string $datatypes
	 * @param array $parameters
	 */
	public function BindParameters($datatypes,$parameters) {
		$types = '';
		$values = array();
		$i = 0;
		foreach (str_split($datatypes) as $type) {
			if (!in_array($type, $this->StatementTypes)) {
				die('ERROR: wrong datatype in MySQL statement');
			} else {
				$types .= $type;
				$values[] = &$parameters[$i]; 
			}
			$i++;
		}
		call_user_func_array(array($this->statement,'bind_param'), array_merge(array($types),$values));
	}
	
	public function GetData() {
		return $this->result->fetch_all();
	}
	
	public function Reset() {
		$this->result->free();
		unset($this->result);
		unset($this->statement);
	}
	/**
	 * Closes the DB connection when class is destroyed
	 */
	public function __destruct() {
		$this->self->close();
	}
}