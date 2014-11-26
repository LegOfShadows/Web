<?php
/**
 * Provides a connector to the database
 * setup in config or provided as an options array
 * @author Ivan
 *
 */
class Database extends Core {
	private $self;
	private $result;
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
		$this->Reset();
		$this->result = $this->self->query ( $query );
		$ok = ($this->result <> true ? $this->result->num_rows : $this->result);
		return $ok;
	}
	public function Result() {
		return $this->result->fetch_all ();
	}
	/**
	 * Resets the result and statement and frees memory;
	 */
	public function Reset() {
		if (isset ( $this->result )) {
			if ($this->result <> true) {
				$this->result->free ();
			}
			unset ( $this->result );
		}
	}
	/**
	 * Closes the DB connection when class is destroyed
	 */
	public function __destruct() {
		$this->Reset ();
		$this->self->close ();
	}
}