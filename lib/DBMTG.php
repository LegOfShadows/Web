<?php
/**
 * Provides a connector to the database using PDO
 * setup in config or provided as an options array
 * @author Ivan
 *
 */
class DBMTG extends Singleton {
	// Connection
	public $con;
	public $db = 'mtg';
	/**
	 * Constructor for the Database Handler Class
	 *
	 * @param array $options:
	 *        	Options array containing host, user, pass, db
	 */
	public function __construct() {
		// Default connection from config.php
		$dsn = 'mysql:host=' . DB_HOSTNAME . ';dbname=' . $this->db;
		$this->con = new PDO ( $dsn, DB_USERNAME, DB_PASSWORD );
	}
	/**
	 * Closes the DB connection when class is destroyed
	 */
	public function __destruct() {
	}
}