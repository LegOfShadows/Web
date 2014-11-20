<?php
namespace lib;
/**
 * Class that provides session control interface
 * for all the core classes
 * @author Ivan
 *
 */
class Session {
	public $vars;
	/**
	 * Builds a new session instance
	 * Pulls data from the global session var when created
	 */
	public function __construct() {
		session_start ();
		$this->notifications = array ();
		$this->vars = $_SESSION;
		/* Initialise Notifications */
	}
	/**
	 * Updates global session var when destroyed
	 */
	public function __destruct() {
		$_SESSION = $this->vars;
	}
	public function __set($key, $value) {
		$this->vars [$key] = $value;
	}
	public function __get($key) {
		return $this->vars [$key];
	}
	public function GetNotifications() {
		$out = $this->notifications;
		$this->notifications = array ();
		return $out;
	}
	public function AddNotification($message) {
		$arr = array (
				$message 
		);
		$this->notifications = array_merge ( $this->notifications, $arr );
	}
}
